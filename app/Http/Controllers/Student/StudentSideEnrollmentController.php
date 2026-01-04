<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Course;
use App\Models\Academic\Enrollment;
use App\Models\People\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSideEnrollmentController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $enrollments = Enrollment::with(['course', 'batch'])
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $courses = Course::where('status', 'active')->get();
        $batches = Batch::where('status', 'active')->get();

        return view('student.enrollments.create', compact('courses', 'batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id'  => 'required|exists:batches,id',
        ]);

        $studentId = Student::where('user_id', auth()->id())->value('id');

        Enrollment::create([
            'student_id' => $studentId,
            'course_id'  => $request->course_id,
            'batch_id'   => $request->batch_id,
            'status'     => 'pending',
        ]);

        return redirect()
            ->route('student.enrollments.index')
            ->with('success', 'Enrollment request submitted');
    }


    public function show($id)
    {
        $student = Student::with('enrollments.course', 'enrollments.batch')
            ->findOrFail($id);

        $courses = Course::where('status', 'active')->get();
        $batches = Batch::where('status', 'active')->get();

        return view('admin.students.view', compact(
            'student',
            'courses',
            'batches'
        ));
    }
}
