<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Course;
use App\Models\Academic\Subjects;
use App\Models\People\Teacher;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with('course')
            ->latest()
            ->get();

        return view('admin.batches.index', compact('batches'));
    }


    public function create()
    {
        $courses = Course::where('status', 'active')->get();

        return view('admin.batches.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'batch_name'    => 'required|string|max:255',
            'batch_code'    => 'required|string|max:50|unique:batches,batch_code',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date',
            'max_students'  => 'nullable|integer|min:1',
            'status'        => 'required|in:active,inactive,completed',
        ]);

        Batch::create($request->all());

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Batch created successfully');
    }


    public function show($id)
    {
        $batch = Batch::with(['course', 'subjects'])->findOrFail($id);

        return view('admin.batches.view', compact('batch'));
    }


    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        $courses = Course::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();

        return view('admin.batches.edit', compact('batch', 'courses', 'teachers'));
    }


    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'batch_name'    => 'required|string|max:255',
            'batch_code'    => 'required|string|max:50|unique:batches,batch_code,' . $batch->id,
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date',
            'max_students'  => 'nullable|integer|min:1',
            'status'        => 'required|in:active,inactive,completed',
        ]);

        $batch->update($request->all());

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Batch updated successfully');
    }


    public function delete($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Batch deleted successfully');
    }


    public function subjectsByBatch(Batch $batch)
    {
        return response()->json(
            $batch->course->subjects()->where('status', 'active')->get()
        );
    }

    public function batches()
    {
        $batches = Batch::whereHas('teachers', function ($q) {
            $q->where('teacher_id', auth()->id());
        })->with(['course', 'subject'])->get();

        return view('teacher.batches.index', compact('batches'));
    }
}
