<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\CourseType;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{

    public function index()
    {
        $courseTypes = CourseType::latest()->get();
        return view('admin.course-types.index', compact('courseTypes'));
    }


    public function create()
    {
        return view('admin.course-types.create');
    }


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


    public function edit(CourseType $courseType)
    {
        return view('admin.course-types.edit', compact('courseType'));
    }

    public function update(Request $request, CourseType $courseType)
    {
        try {
            $request->validate([
                'type_name'   => 'required|string|max:255|unique:course_types,type_name,' . $courseType->id,
                'description' => 'nullable|string',
                'status'      => 'required|in:active,inactive',
            ]);

            $courseType->update([
                'type_name'   => $request->type_name,
                'description' => $request->description,
                'status'      => $request->status,
            ]);

            return redirect()
                ->route('admin.course-types.index')
                ->with('success', 'Course Type updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while updating the Course Type: ' . $e->getMessage());
        }
    }


    public function view(CourseType $courseType)
    {
        return view('admin.course-types.view', compact('courseType'));
    }


    public function delete(CourseType $courseType)
    {
        $courseType->delete();

        return redirect()
            ->route('admin.course-types.index')
            ->with('success', 'Course Type deleted successfully');
    }
}
