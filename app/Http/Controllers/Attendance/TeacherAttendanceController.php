<?php

namespace App\Http\Controllers\Attendance;


use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use App\Models\Academic\TeacherAssignment;
use App\Models\People\Teacher;
use App\Models\Attendance\TeacherAttendance;
use App\Services\TeacherAttendanceExcelExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;




class TeacherAttendanceController extends Controller
{
public function index(Request $request)
{
    $attendances = TeacherAttendance::with(['teacher', 'batch', 'subject'])
        ->when($request->teacher_id, function ($q) use ($request) {
            $q->where('teacher_id', $request->teacher_id);
        })
        ->when($request->batch_id, function ($q) use ($request) {
            $q->where('batch_id', $request->batch_id);
        })
        ->when($request->date, function ($q) use ($request) {
            $q->whereDate('attendance_date', $request->date);
        })
        ->orderBy('attendance_date', 'desc')
        ->get();

    $teachers = Teacher::orderBy('first_name')->get();
    $batches  = Batch::orderBy('batch_name')->get();

    return view('admin.teacher-attendance.index', compact(
        'attendances',
        'teachers',
        'batches'
    ));
}


    /**
     * Show create attendance form
     */
    public function create(Request $request)
    {
        $batches = Batch::where('status', 'active')->get();

        $assignments = null;

        // Only load when batch is selected
        if ($request->filled('batch_id')) {
            $assignments = TeacherAssignment::with([
                    'teacher',
                    'subject'
                ])
                ->where('batch_id', $request->batch_id)
                ->where('status', 'active')
                ->get();
        }

        return view(
            'admin.teacher-attendance.create',
            compact('batches', 'assignments')
        );
    }

    /**
     * Store attendance
     */
    public function store(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'batch_id'        => 'required|exists:batches,id',
            'attendance'      => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->attendance as $assignmentId => $data) {

                $assignment = TeacherAssignment::findOrFail($assignmentId);

                TeacherAttendance::updateOrCreate(
                    [
                        // Unique keys
                        'teacher_id'       => $assignment->teacher_id,
                        'batch_id'         => $assignment->batch_id,
                        'subject_id'       => $assignment->subject_id,
                        'attendance_date'  => $request->attendance_date,
                    ],
                    [
                        // Values
                        'status'     => $data['status'],
                        'start_time' => $data['start_time'] ?? null,
                        'end_time'   => $data['end_time'] ?? null,
                        'remarks'    => $data['remarks'] ?? null,
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('admin.teacher-attendance.index')
                ->with('success', 'Teacher attendance saved successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }
    /**
     * Edit attendance
     */
    public function edit($id)
    {
        $attendance = TeacherAttendance::findOrFail($id);

        return view('admin.teacher-attendance.edit', compact('attendance'));
    }

    /**
     * Update attendance
     */
    public function update(Request $request, $id)
    {
        $attendance = TeacherAttendance::findOrFail($id);

        $attendance->update([
            'status'     => $request->status,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'remarks'    => $request->remarks,
        ]);

        return redirect()
            ->route('admin.teacher-attendance.index')
            ->with('success', 'Attendance updated successfully');
    }



    /**
     * Delete attendance
     */
    public function destroy(TeacherAttendance $teacherAttendance)
    {
        $teacherAttendance->delete();

        return redirect()
            ->route('admin.teacher-attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }

    public function report(Request $request)
    {
        // 🔹 Load dropdown data
        $teachers = Teacher::orderBy('first_name')->get();
        $batches  = Batch::orderBy('batch_code')->get();
        $subjects = Subjects::orderBy('subject_name')->get();

        $monthlySummary = TeacherAttendance::select(
        DB::raw("DATE_FORMAT(attendance_date, '%Y-%m') as month"),
        DB::raw("SUM(status = 'present') as present"),
        DB::raw("SUM(status = 'absent') as absent"),
        DB::raw("SUM(status = 'late') as late"),
        DB::raw("SUM(status = 'cancelled') as cancelled")
        )
        ->when($request->teacher_id, fn($q) =>
            $q->where('teacher_id', $request->teacher_id)
        )
        ->when($request->batch_id, fn($q) =>
            $q->where('batch_id', $request->batch_id)
        )
        ->when($request->from_date && $request->to_date, fn($q) =>
            $q->whereBetween('attendance_date', [
                $request->from_date,
                $request->to_date
            ])
        )
        ->groupBy('month')
        ->orderBy('month', 'desc')
        ->get();



        $teacherSummary = TeacherAttendance::select(
        'teacher_id',
        DB::raw("SUM(status = 'present') as present"),
        DB::raw("SUM(status = 'absent') as absent"),
        DB::raw("SUM(status = 'late') as late"),
        DB::raw("SUM(status = 'cancelled') as cancelled"),
        DB::raw("COUNT(*) as total")
        )
        ->with('teacher')
        ->when($request->batch_id, fn($q) =>
            $q->where('batch_id', $request->batch_id)
        )
        ->when($request->from_date && $request->to_date, fn($q) =>
            $q->whereBetween('attendance_date', [
                $request->from_date,
                $request->to_date
            ])
        )
        ->groupBy('teacher_id')
        ->get();


        // 🔹 Attendance query
        $query = TeacherAttendance::with(['teacher', 'batch', 'subject']);

        if ($request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->batch_id) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->subject_id) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('attendance_date', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $attendances = $query
            ->orderBy('attendance_date', 'desc')
            ->get();

        // 🔹 Summary
        $summary = [
            'present'   => $attendances->where('status', 'present')->count(),
            'absent'    => $attendances->where('status', 'absent')->count(),
            'late'      => $attendances->where('status', 'late')->count(),
            'cancelled' => $attendances->where('status', 'cancelled')->count(),
        ];

        return view(
            'admin.teacher-attendance.report',
            compact(
            'teachers',
            'batches',
            'subjects',
            'attendances',
            'summary',
            'monthlySummary',
            'teacherSummary'

            )
        );
    }

    public function exportPdf(Request $request)
    {
        $query = TeacherAttendance::with(['teacher', 'batch', 'subject']);

        if ($request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->batch_id) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('attendance_date', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $attendances = $query->get();

        $pdf = Pdf::loadView(
            'admin.teacher-attendance.export-pdf',
            compact('attendances')
        )->setPaper('a4', 'landscape');

        return $pdf->download('teacher-attendance-report.pdf');
    }


    public function exportExcel(Request $request)
    {
        return TeacherAttendanceExcelExport::export($request);
    }

}
