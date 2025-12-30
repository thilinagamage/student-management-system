<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\Course;
use App\Models\Academic\Subjects;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subjects::with('course')->latest()->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $courses = Course::where('status','active')->get();
        return view('admin.subjects.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'subject_name' => 'required',
            'subject_code' => 'required|unique:subjects'
        ]);

        Subjects::create($request->all());

        return redirect()->route('admin.subjects.index')
            ->with('success','Subject created successfully');
    }

    public function edit($id)
    {
        $subject = Subjects::findOrFail($id);
        $courses = Course::where('status','active')->get();

        return view('admin.subjects.edit', compact('subject','courses'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subjects::findOrFail($id);

        $request->validate([
            'course_id' => 'required',
            'subject_name' => 'required',
            'subject_code' => 'required|unique:subjects,subject_code,'.$id
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')
            ->with('success','Subject updated successfully');
    }

    public function show($id)
    {
        $subject = Subjects::with('course')->findOrFail($id);
        return view('admin.subjects.view', compact('subject'));
    }

    public function delete($id)
    {
        $subject = Subjects::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success','Subject deleted successfully');
    }

    public function subjects()
    {
        $subjects = Subjects::whereHas('batches.teachers', function ($q) {
            $q->where('teachers.id', auth()->id());
        })->with('course')->get();

        return view('teacher.subjects.index', compact('subjects'));
    }

}
