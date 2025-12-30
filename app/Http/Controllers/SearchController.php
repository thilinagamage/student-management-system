<?php

namespace App\Http\Controllers;

use App\Models\Academic\Batch;
use App\Models\People\Student;
use App\Models\People\Teacher;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $students = Student::where('first_name', 'like', "%$q%")
            ->orWhere('last_name', 'like', "%$q%")
            ->orWhere('student_id', 'like', "%$q%")
            ->limit(5)
            ->get();

        $teachers = Teacher::where('first_name', 'like', "%$q%")
            ->orWhere('last_name', 'like', "%$q%")
            ->limit(5)
            ->get();

        $batches = Batch::where('batch_code', 'like', "%$q%")
            ->limit(5)
            ->get();

        return view('admin.search.index', compact(
            'q',
            'students',
            'teachers',
            'batches'
        ));
    }
}
