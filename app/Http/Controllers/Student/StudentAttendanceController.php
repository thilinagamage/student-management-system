<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Enrollment;
use App\Models\Attendance\StudentAttendance;
use App\Models\People\Student;
use App\Models\People\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentAttendanceController extends Controller
{


    public function index(Request $request)
    {

        $teacherId = Teacher::where('user_id', auth()->id())->value('id');
        if (!$teacherId) abort(403, 'Teacher profile not found');

        $batches = Batch::whereIn('id', function($q) use ($teacherId) {
            $q->select('batch_id')
            ->from('teacher_assignments')
            ->where('teacher_id', $teacherId)
            ->where('status', 'active');
        })->get();


        $students = Student::whereHas('enrollments', function($q) use ($batches) {
            $q->whereIn('batch_id', $batches->pluck('id'))
            ->where('status', 'approved');
        })->orderBy('first_name')->get();


        $attendances = StudentAttendance::with(['student', 'batch'])
            ->whereIn('batch_id', $batches->pluck('id'))
            ->when($request->student_id, fn($q) => $q->where('student_id', $request->student_id))
            ->when($request->batch_id, fn($q) => $q->where('batch_id', $request->batch_id))
            ->when($request->date, fn($q) => $q->where('attendance_date', $request->date))
            ->orderBy('attendance_date', 'desc')
            ->paginate(10);

        return view('teacher.student-attendance.index', compact('attendances', 'batches', 'students'));
    }




    public function create(Request $request)
    {

        $teacherId = Teacher::where('user_id', auth()->id())->value('id');

        if (!$teacherId) {
            abort(403, 'Teacher profile not found');
        }


        $batches = Batch::whereIn('id', function ($q) use ($teacherId) {
            $q->select('batch_id')
            ->from('teacher_assignments')
            ->where('teacher_id', $teacherId)
            ->where('status', 'active');
        })->get();

    $students = collect();

    if ($request->filled('batch_id')) {

        abort_unless(
            \DB::table('teacher_assignments')
                ->where('teacher_id', $teacherId)
                ->where('batch_id', $request->batch_id)
                ->exists(),
            403
        );


        $students = Enrollment::with('student')
            ->where('batch_id', $request->batch_id)
            ->where('status', 'approved')
            ->get()
            ->pluck('student');
    }



        return view('teacher.student-attendance.create', compact('batches', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'         => 'required|exists:batches,id',
            'attendance_date'  => 'required|date',
            'attendance'       => 'required|array',
        ]);

        $teacherId = Teacher::where('user_id', auth()->id())->value('id');

        DB::beginTransaction();

        try {
            foreach ($request->attendance as $studentId => $status) {
                StudentAttendance::updateOrCreate(
                    [
                        'student_id'      => $studentId,
                        'batch_id'        => $request->batch_id,
                        'attendance_date' => $request->attendance_date,
                    ],
                    [
                        'status'     => $status,
                        'teacher_id' => $teacherId,
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('teacher.student-attendance.create')
                ->with('success', 'Attendance saved successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }



    public function destroy(StudentAttendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('teacher.student-attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    public function edit($batchId, $date)
    {

        $batch = Batch::findOrFail($batchId);


        $attendances = StudentAttendance::with('student')
            ->where('batch_id', $batchId)
            ->whereDate('attendance_date', $date)
            ->orderBy('student_id')
            ->get();


        if ($attendances->isEmpty()) {
            return redirect()
                ->route('admin.student-attendance.index')
                ->with('error', 'No attendance records found for the selected date.');
        }


        return view('teacher.student-attendance.edit', [
            'batch'       => $batch,
            'date'        => $date,
            'attendances' => $attendances,
        ]);
    }

    public function update(Request $request, $batchId, $date)
    {
        foreach ($request->attendance as $studentId => $data) {
            StudentAttendance::where('batch_id', $batchId)
                ->where('student_id', $studentId)
                ->whereDate('attendance_date', $date)
                ->update([
                    'status'  => $data['status'],
                    'remarks' => $data['remarks'] ?? null,
                ]);
        }

        return redirect()
            ->route('teacher.student-attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }


    public function getStudents(Request $request)
    {
        $students = Student::whereHas('batches', function ($q) use ($request) {
            $q->where('batches.id', $request->batch_id);
        })
        ->where('status', 'active')
        ->get();


        return response()->json($students);
    }


     public function studentMyattendance(Request $request)
    {
        $student = auth()->user()->student;

        $attendances = StudentAttendance::with(['batch', 'subject'])
            ->where('student_id', $student->id)
            ->when($request->batch_id, fn ($q) =>
                $q->where('batch_id', $request->batch_id)
            )
            ->orderBy('attendance_date', 'desc')
            ->paginate(10);

        return view('student.attendance.index', compact('attendances'));
    }



}
