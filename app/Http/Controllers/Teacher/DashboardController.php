<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use App\Models\Academic\TeacherAssignment;
use App\Models\Attendance\TeacherAttendance;
use App\Models\People\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function teacherDashboard()
    {
        $teacher = auth()->user()->teacher;

        $totalBatches = $teacher->batches()->count();

        $totalSubjects = $teacher->subjects()->count();

        $totalStudents = Student::whereHas('batches', function ($q) use ($teacher) {
            $q->whereIn('batches.id', $teacher->batches->pluck('id'));
        })->distinct()->count('students.id');

        $today = \Carbon\Carbon::today()->toDateString();
        $todayAttendance = TeacherAttendance::where('teacher_id', $teacher->id)
            ->whereDate('attendance_date', $today)
            ->first();


        $todayClasses = TeacherAssignment::where('teacher_id', $teacher->id)
            ->with(['batch', 'subject'])
            ->get();

        return view('teacher.dashboard', compact(
            'teacher',
            'totalBatches',
            'totalSubjects',
            'totalStudents',
            'todayAttendance',
            'todayClasses'
        ));
    }
}
