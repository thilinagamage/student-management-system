<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use Illuminate\Http\Request;

class BatchSubjectController extends Controller
{
    public function create(Batch $batch)
    {
        $subjects = Subjects::where('status', 'active')->get();

        return view('admin.batches.assign-subject', compact('batch', 'subjects'));
    }

    public function store(Request $request, Batch $batch)
    {
        $request->validate([
            'subjects'   => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $batch->subjects()->sync($request->subjects ?? []);

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Subjects assigned successfully');
    }
}
