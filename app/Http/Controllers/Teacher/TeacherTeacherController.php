<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\People\Teacher;
use Illuminate\Http\Request;

class TeacherTeacherController extends Controller
{
     public function myBatches()
    {
        $teacherId = Teacher::where('user_id', auth()->id())->value('id');

        if (!$teacherId) {
            abort(403, 'Teacher profile not found');
        }

    $batches = Batch::with(['course', 'subjects'])
        ->whereIn('id', function($q) use ($teacherId) {
            $q->select('batch_id')
            ->from('teacher_assignments')
            ->where('teacher_id', $teacherId)
            ->where('status', 'active');
        })->get();
        return view('teacher.batches.index', compact('batches'));
    }
}
