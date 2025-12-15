<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance\StudentAttendanceSession;
use App\Models\People\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAttendanceController extends Controller
{
    public function index(){
        return view('admin.attendance.student.index');

    }

public function create(Request $request)
{
    $students = [];

    if ($request->batch_id) {
        $students = Student::where('batch_id', $request->batch_id)
            ->where('status', 'active')
            ->get();
    }

    return view('admin.attendance.student.create', compact('students'));
}

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $session = StudentAttendanceSession::create([
                'attendance_date' => $request->attendance_date,
                'course_id' => $request->course_id,
                'batch_id' => $request->batch_id,
                'marked_by' => auth()->id(),
            ]);

            foreach ($request->attendance as $student_id => $status) {
                StudentAttendanceSession::create([
                    'attendance_session_id' => $session->id,
                    'student_id' => $student_id,
                    'status' => $status,
                ]);
            }
        });

        return back()->with('success', 'Attendance saved successfully');
    }
}
