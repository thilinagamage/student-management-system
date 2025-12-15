<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\CourseType;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
        // LIST
    public function index()
    {
        $courseTypes = CourseType::latest()->get();
        return view('admin.course-types.index', compact('courseTypes'));
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.course-types.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        CourseType::create([
        'type_name'   => $request->type_name,
        'description' => $request->description,
        'status'      => $request->status,
        ]);

        return redirect()
            ->route('admin.course-types.index')
            ->with('success', 'Course Type created successfully');
    }

    // EDIT FORM
    public function edit(CourseType $courseType)
    {
        return view('admin.course-types.edit', compact('courseType'));
    }

    // UPDATE
    public function update(Request $request, CourseType $courseType)
    {
        $request->validate([
            'type_name' => 'required|unique:course_types,type_name,' . $courseType->id,
            'status'    => 'required',
        ]);

        $courseType->update($request->all());

        return redirect()
            ->route('admin.course-types.index')
            ->with('success', 'Course Type updated successfully');
    }

    // DELETE
    public function destroy(CourseType $courseType)
    {
        $courseType->delete();

        return redirect()
            ->route('admin.course-types.index')
            ->with('success', 'Course Type deleted successfully');
    }
}
