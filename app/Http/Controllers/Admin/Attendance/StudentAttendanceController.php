<?php

namespace App\Http\Controllers\Admin\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Attendance\StudentAttendance;
use App\Models\People\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = StudentAttendance::with(['student', 'batch', 'subject'])
            ->when(
                $request->student_id,
                fn($q) =>
                $q->where('student_id', $request->student_id)
            )
            ->when(
                $request->batch_id,
                fn($q) =>
                $q->where('batch_id', $request->batch_id)
            )
            ->when(
                $request->date,
                fn($q) =>
                $q->whereDate('attendance_date', $request->date)
            )
            ->orderBy('attendance_date', 'desc')
            ->get();

        return view('admin.student-attendance.index', [
            'attendances' => $attendances,
            'students'    => Student::orderBy('first_name')->get(),
            'batches'     => Batch::orderBy('batch_code')->get(),
        ]);
    }
    public function create(Request $request)
    {
        $batches = Batch::where('status', 'active')->get();
        $students = collect();

        if ($request->filled('batch_id')) {
            $batchId = $request->batch_id;

            $students = Student::whereHas('enrollments', function ($q) use ($batchId) {
                $q->where('batch_id', $batchId)
                    ->where('status', 'approved');
            })
                ->orderBy('first_name')
                ->get();
        }

        return view('admin.student-attendance.create', compact('batches', 'students'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'batch_id'        => 'required',
            'attendance'      => 'required|array',
        ]);

        DB::transaction(function () use ($request) {

            foreach ($request->attendance as $studentId => $data) {
                StudentAttendance::updateOrCreate(
                    [
                        'student_id'      => $studentId,
                        'batch_id'        => $request->batch_id,
                        'attendance_date' => $request->attendance_date,
                    ],
                    [
                        'status'     => $data['status'],
                        'remarks'    => $data['remarks'] ?? null,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Student attendance saved successfully.');
    }


    public function edit($batchId, $date)
    {
        $batch = Batch::findOrFail($batchId);

        $attendances = StudentAttendance::with('student')
            ->where('batch_id', $batchId)
            ->whereDate('attendance_date', $date)
            ->get();

        return view('admin.student-attendance.edit', [
            'batch'       => $batch,
            'date'        => $date,
            'attendances' => $attendances,
        ]);
    }

    public function update(Request $request, $batchId, $date)
    {
        $request->validate([
            'attendance' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $batchId, $date) {

            foreach ($request->attendance as $attendanceId => $data) {
                StudentAttendance::where('id', $attendanceId)
                    ->update([
                        'status'  => $data['status'],
                        'remarks' => $data['remarks'] ?? null,
                    ]);
            }
        });

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }



    public function destroy($batchId, $date)
    {
        DB::transaction(function () use ($batchId, $date) {

            StudentAttendance::where('batch_id', $batchId)
                ->whereDate('attendance_date', $date)
                ->delete();
        });

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }

    public function destroySingle(StudentAttendance $attendance)
    {
        $attendance->delete();

        return back()->with('success', 'Student attendance deleted.');
    }


    public function report(Request $request)
    {
        $query = StudentAttendance::with(['student', 'batch', 'subject']);

        if ($request->student_id) {
            $query->where('student_id', $request->student_id);
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

        $attendances = $query->orderBy('attendance_date')->get();

        $summary = [
            'present'   => $attendances->where('status', 'present')->count(),
            'absent'    => $attendances->where('status', 'absent')->count(),
            'late'      => $attendances->where('status', 'late')->count(),
            'excused'   => $attendances->where('status', 'excused')->count(),
        ];



        $monthlySummary = StudentAttendance::select(
            'student_id',
            'batch_id',
            DB::raw("DATE_FORMAT(attendance_date, '%Y-%m') as month"),
            DB::raw("SUM(status='present') as present"),
            DB::raw("SUM(status='absent') as absent"),
            DB::raw("SUM(status='late') as late"),
            DB::raw("SUM(status='excused') as excused")
        )
            ->with(['student', 'batch'])
            ->groupBy('student_id', 'batch_id', 'month')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.student-attendance.report', [
            'students'    => Student::orderBy('first_name')->get(),
            'batches'     => Batch::orderBy('batch_code')->get(),
            'attendances' => $attendances,
            'summary'     => $summary,
            'monthlySummary' => $monthlySummary,

        ]);
    }

    public function batchReport(Request $request)
    {
        $batches = Batch::orderBy('batch_code')->get();

        $query = StudentAttendance::with(['student', 'batch']);

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('attendance_date', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $records = $query->get()
            ->groupBy('student_id')
            ->map(function ($items) {
                $total = $items->count();

                return [
                    'student'  => $items->first()->student,
                    'batch'    => $items->first()->batch,
                    'present'  => $items->where('status', 'present')->count(),
                    'absent'   => $items->where('status', 'absent')->count(),
                    'late'     => $items->where('status', 'late')->count(),
                    'excused'  => $items->where('status', 'excused')->count(),
                    'total'    => $total,
                    'percentage' => $total > 0
                        ? round(($items->where('status', 'present')->count() / $total) * 100, 2)
                        : 0,
                ];
            });

        return view('admin.student-attendance.batch-report', compact(
            'batches',
            'records'
        ));
    }

    private function getBatchAttendanceData($request)
    {
        return StudentAttendance::with(['student', 'batch'])
            ->when(
                $request->batch_id,
                fn($q) =>
                $q->where('batch_id', $request->batch_id)
            )
            ->when(
                $request->from_date && $request->to_date,
                fn($q) => $q->whereBetween('attendance_date', [
                    $request->from_date,
                    $request->to_date
                ])
            )
            ->get()
            ->groupBy('student_id')
            ->map(function ($items) {

                $total = $items->count();
                $present = $items->where('status', 'present')->count();

                return [
                    'student'     => $items->first()->student->full_name,
                    'batch'       => $items->first()->batch->batch_code,
                    'present'     => $present,
                    'absent'      => $items->where('status', 'absent')->count(),
                    'late'        => $items->where('status', 'late')->count(),
                    'excused'     => $items->where('status', 'excused')->count(),
                    'total'       => $total,
                    'percentage'  => $total > 0 ? round(($present / $total) * 100, 2) : 0,
                ];
            });
    }


    public function exportBatchExcel(Request $request)
    {
        $data = $this->getBatchAttendanceData($request);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        
        $sheet->fromArray([
            'Student',
            'Batch',
            'Present',
            'Absent',
            'Late',
            'Excused',
            'Total',
            'Attendance %'
        ], null, 'A1');


        $row = 2;
        foreach ($data as $item) {
            $sheet->fromArray([
                $item['student'],
                $item['batch'],
                $item['present'],
                $item['absent'],
                $item['late'],
                $item['excused'],
                $item['total'],
                $item['percentage'] . '%',
            ], null, 'A' . $row);
            $row++;
        }

        $fileName = 'batch-attendance-report.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(
            fn() => $writer->save('php://output'),
            $fileName
        );
    }

    public function exportBatchPdf(Request $request)
    {
        $records = $this->getBatchAttendanceData($request);

        $pdf = Pdf::loadView(
            'admin.student-attendance.batch-report-pdf',
            compact('records')
        )->setPaper('A4', 'landscape');

        return $pdf->download('batch-attendance-report.pdf');
    }
}
