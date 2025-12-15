<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\Course;
use App\Models\Academic\CourseType;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('courseType')->latest()->get();

        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show create course form
     */
    public function create()
    {
        $courseTypes = CourseType::where('status', 'active')->get();

        return view('admin.course.create', compact('courseTypes'));
    }

    /**
     * Store new course
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name'      => 'required|string|max:255',
            'course_code'      => 'required|string|max:50|unique:courses,course_code',
            'course_type_id'   => 'required|exists:course_types,id',
            'course_fee'       => 'nullable|numeric',
            'duration'         => 'nullable|integer',
            'duration_type'    => 'nullable|in:weeks,months,years',
            'description'      => 'nullable|string',
            'status'           => 'required|in:active,inactive',
        ]);

        Course::create([
            'course_name'    => $request->course_name,
            'course_code'    => $request->course_code,
            'course_type_id' => $request->course_type_id,
            'course_fee'     => $request->course_fee,
            'duration'       => $request->duration,
            'duration_type'  => $request->duration_type,
            'description'    => $request->description,
            'status'         => $request->status,
        ]);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course created successfully');
    }

    /**
     * Show edit course form
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $courseTypes = CourseType::where('status', 'active')->get();

        return view('admin.course.edit', compact('course', 'courseTypes'));
    }

    /**
     * Update course
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'course_name'    => 'required|string|max:255',
            'course_code'    => 'required|string|max:50|unique:courses,course_code,' . $course->id,
            'course_type_id' => 'required|exists:course_types,id',
            'course_fee'     => 'nullable|numeric',
            'duration'       => 'nullable|integer',
            'duration_type'  => 'nullable|in:weeks,months,years',
            'description'    => 'nullable|string',
            'status'         => 'required|in:active,inactive',
        ]);

        $course->update([
            'course_name'    => $request->course_name,
            'course_code'    => $request->course_code,
            'course_type_id' => $request->course_type_id,
            'course_fee'     => $request->course_fee,
            'duration'       => $request->duration,
            'duration_type'  => $request->duration_type,
            'description'    => $request->description,
            'status'         => $request->status,
        ]);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully');
    }

    /**
     * Delete course (soft delete recommended)
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
