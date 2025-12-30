<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use App\Models\Academic\TeacherAssignment;
use App\Models\People\Teacher;
use Illuminate\Http\Request;

class TeacherAssignmentController extends Controller
{
    /**
     * List all teacher assignments
     */
    public function index()
    {
        $assignments = TeacherAssignment::with([
            'teacher',
            'batch.course',
            'subject'
        ])->latest()->get();

        return view('admin.teacher-assignments.index', compact('assignments'));
    }

    /**
     * Show create assignment form
     */
    public function create()
    {
        $batches  = Batch::with('course')->where('status', 'active')->get();
        $subjects = Subjects::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();

        return view(
            'admin.teacher-assignments.create',
            compact('batches', 'subjects', 'teachers')
        );
    }

    /**
     * Store teacher assignment
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'batch_id'   => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'status'     => 'required|in:active,inactive',
        ]);

        TeacherAssignment::create([
            'teacher_id' => $request->teacher_id,
            'batch_id'   => $request->batch_id,
            'subject_id' => $request->subject_id,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('admin.teacher-assignments.index')
            ->with('success', 'Teacher assigned successfully');
    }

    public function edit(TeacherAssignment $assignment)
    {
        $teachers = Teacher::where('status', 'active')->get();

        return view('admin.teacher-assignments.edit', compact('assignment', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'status'     => 'required',
        ]);

        $teacher->update($request->all());

        return redirect()
            ->route('admin.teachers.show', $teacher->id)
            ->with('success', 'Teacher updated successfully');
    }



    /**
     * Delete assignment (optional)
     */
    public function delete($id)
    {
        TeacherAssignment::findOrFail($id)->delete();

        return back()->with('success', 'Assignment deleted');
    }


}
