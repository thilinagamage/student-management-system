<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\People\Student;
use Illuminate\Http\Request;

class StudentEnrollmentController extends Controller
{

    public function index()
    {
    $enrollments = Student::with([
        'batches' => function ($q) {
            $q->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
        }
    ])->whereHas('batches')->get();


        return view('admin.student-enrollment.index', compact('enrollments'));
    }


    public function create()
    {
        return view('admin.student-enrollment.create', [
            'students' => Student::orderBy('first_name')->get(),
            'batches'  => Batch::where('status', 'active')->get(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'batch_ids'  => 'required|array',
        ]);

        $student = Student::findOrFail($request->student_id);

        foreach ($request->batch_ids as $batchId) {
            $student->batches()->syncWithoutDetaching([
                $batchId => [
                    'enrolled_date' => now(),
                    'status' => 'active'
                ]
            ]);
        }

        return redirect()->route('admin.student-enrollment.index')
            ->with('success', 'Student enrolled successfully.');
    }


    public function edit($studentId)
    {
        $student = Student::with('batches')->findOrFail($studentId);
        $batches = Batch::orderBy('batch_code')->get();

        // already assigned batch IDs
        $assignedBatchIds = $student->batches->pluck('id')->toArray();

        return view(
            'admin.student-enrollment.edit',
            compact('student', 'batches', 'assignedBatchIds')
        );
    }

    public function update(Request $request, $studentId)
    {
        $request->validate([
            'batch_ids' => 'required|array',
            'batch_ids.*' => 'exists:batches,id',
        ]);

        $student = Student::findOrFail($studentId);

        // sync batches (add/remove automatically)
        $student->batches()->sync($request->batch_ids);

        return redirect()
            ->route('admin.student-enrollment.index')
            ->with('success', 'Student enrollment updated successfully');
    }

    public function destroy($studentId)
    {
        $student = Student::findOrFail($studentId);

        // remove from ALL batches
        $student->batches()->detach();

        return back()->with('success', 'Student removed from all batches.');
    }

}

