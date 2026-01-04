<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Attendance\StudentAttendance;
use App\Models\People\Student;
use App\Models\People\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{


    public function studentDashboard(){
        $student = auth()->user()->student;

        $totalClasses = StudentAttendance::where('student_id', $student->id)->count();

        $presentCount = StudentAttendance::where('student_id', $student->id)
            ->where('status', 'present')
            ->count();

        $absentCount = StudentAttendance::where('student_id', $student->id)
            ->where('status', 'absent')
            ->count();

        $todayAttendance = StudentAttendance::where('student_id', $student->id)
            ->whereDate('attendance_date', Carbon::today())
            ->first();

        $recentAttendances = StudentAttendance::with('subject')
            ->where('student_id', $student->id)
            ->latest('attendance_date')
            ->limit(6)
            ->get();

        return view('student.dashboard', compact(
            'student',
            'totalClasses',
            'presentCount',
            'absentCount',
            'todayAttendance',
            'recentAttendances'
        ));

    }



}
