<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\TeacherAssignment;
use App\Models\Attendance\StudentAttendance;
use App\Models\People\Student;
use App\Models\People\Teacher;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{

    /**
     * Show mark attendance form (TEACHER)
     */
public function create(Request $request)
{
    // Get teacher id correctly
    $teacherId = Teacher::where('user_id', auth()->id())->value('id');

    if (!$teacherId) {
        abort(403, 'Teacher profile not found');
    }

    // Load only assigned batches
    $batches = Batch::whereIn('id', function ($q) use ($teacherId) {
        $q->select('batch_id')
          ->from('teacher_assignments')
          ->where('teacher_id', $teacherId)
          ->where('status', 'active');
    })->get();

    $students = collect();

    if ($request->filled('batch_id')) {
        // Security check
        abort_unless(
            \DB::table('teacher_assignments')
                ->where('teacher_id', $teacherId)
                ->where('batch_id', $request->batch_id)
                ->exists(),
            403
        );

        $students = Student::where('batch_id', $request->batch_id)
            ->where('status', 'active')
            ->get();
    }

    return view('teacher.attendance.create', compact('batches', 'students'));
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
                ->route('teacher.attendance.create')
                ->with('success', 'Attendance saved successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }

}
