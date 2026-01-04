<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Enrollment;
use App\Models\Academic\Subjects;
use App\Models\Academic\TeacherAssignment;
use App\Models\Attendance\StudentAttendance;
use App\Models\Attendance\TeacherAttendance;
use App\Models\People\Student;
use App\Models\People\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherAttendanceController extends Controller
{


    public function index(Request $request)
    {
        $teacher = auth()->user()->teacher;

        $batches = Batch::whereIn('id', function ($q) use ($teacher) {
            $q->select('batch_id')->from('teacher_assignments')
                ->where('teacher_id', $teacher->id)
                ->where('status', 'active');
        })->get();

        $attendances = TeacherAttendance::with('batch', 'subject')
            ->where('teacher_id', $teacher->id)
            ->when($request->batch_id, fn($q) => $q->where('batch_id', $request->batch_id))
            ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->subject_id))
            ->orderBy('attendance_date', 'desc')
            ->paginate(10);

        return view('teacher.teacher-attendance.index', compact('attendances', 'batches'));
    }


    public function create()
    {
        $teacher = auth()->user()->teacher;

        $batches = Batch::whereIn('id', function ($q) use ($teacher) {
            $q->select('batch_id')->from('teacher_assignments')
                ->where('teacher_id', $teacher->id)
                ->where('status', 'active');
        })->get();

        $subjects = Subjects::whereIn('id', function ($q) use ($teacher) {
            $q->select('subject_id')->from('teacher_assignments')
                ->where('teacher_id', $teacher->id)
                ->where('status', 'active');
        })->get();

        return view('teacher.teacher-attendance.create', compact('batches', 'subjects'));
    }


    public function store(Request $request)
    {
        $teacher = auth()->user()->teacher;

        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,cancelled',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        TeacherAttendance::updateOrCreate(
            [
                'teacher_id' => $teacher->id,
                'batch_id' => $request->batch_id,
                'subject_id' => $request->subject_id,
                'attendance_date' => $request->attendance_date,
            ],
            [
                'status' => $request->status,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'remarks' => $request->remarks,
            ]
        );

        return redirect()->route('teacher.teacher-attendance.index')->with('success', 'Attendance marked successfully');
    }


    public function edit($id)
    {
        $attendance = TeacherAttendance::findOrFail($id);
        $teacher = auth()->user()->teacher;

        if ($attendance->teacher_id != $teacher->id) {
            abort(403);
        }

        $batches = Batch::whereIn('id', function ($q) use ($teacher) {
            $q->select('batch_id')->from('teacher_assignments')
                ->where('teacher_id', $teacher->id)
                ->where('status', 'active');
        })->get();

        $subjects = Subjects::whereIn('id', function ($q) use ($teacher) {
            $q->select('subject_id')->from('teacher_assignments')
                ->where('teacher_id', $teacher->id)
                ->where('status', 'active');
        })->get();

        return view('teacher.teacher-attendance.edit', compact('attendance', 'batches', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $attendance = TeacherAttendance::findOrFail($id);
        $teacher = auth()->user()->teacher;
        if ($attendance->teacher_id != $teacher->id) {
            abort(403);
        }

        $request->validate([
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent,late,cancelled',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'remarks' => 'nullable|string|max:255',
        ]);

        $attendance->teacher_id = $teacher->id;
        $attendance->attendance_date = $request->attendance_date;
        $attendance->status = $request->status;
        $attendance->start_time = $request->start_time;
        $attendance->end_time = $request->end_time;
        $attendance->remarks = $request->remarks;

        $attendance->save();

        return redirect()->route('teacher.teacher-attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = TeacherAttendance::findOrFail($id);
        $teacher = auth()->user()->teacher;

        if ($attendance->teacher_id != $teacher->id) {
            abort(403);
        }

        $attendance->delete();

        return redirect()->route('teacher.teacher-attendance.index')->with('success', 'Attendance deleted successfully');
    }
}
