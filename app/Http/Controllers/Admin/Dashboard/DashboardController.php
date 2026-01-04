<?php

namespace App\Http\Controllers\Admin\Dashboard;

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

    public function adminDashboard()
    {
        return view('admin.dashboard', [
            'totalStudents' => Student::count(),
            'totalTeachers' => Teacher::count(),
            'totalBatches'  => Batch::count(),

            'todayAttendanceCount' => StudentAttendance::whereDate(
                'attendance_date',
                Carbon::today()
            )->count(),

            'recentAttendances' => StudentAttendance::with(['student', 'batch'])
                ->latest('attendance_date')
                ->limit(8)
                ->get(),
        ]);
    }
}
