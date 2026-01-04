<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\Academic\Course;
use App\Models\Academic\Enrollment;
use App\Models\People\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {

        $students = Student::with('enrollments.course')
            ->latest()
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $courses = Course::orderBy('course_name')->get();
        $batches = Batch::orderBy('batch_name')->get();

        return view('admin.students.create', compact('courses', 'batches'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([

                'username' => 'required|unique:users,username',
                'login_email' => 'required|email|unique:users,login_email',
                'password' => 'required|min:8',


                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'nullable|in:male,female,other',
                'dob' => 'nullable|date',
                'age' => 'nullable|integer|min:0',
                'course_id'  => 'nullable|exists:courses,id',
                'batch_id'   => 'nullable|exists:batches,id',
                'nic_number' => 'nullable|string|unique:students,nic_number',
                'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',


            ]);


            DB::transaction(function () use ($request) {


                $user = User::create([
                    'username' => $request->username,
                    'login_email' => $request->login_email,
                    'password' => Hash::make($request->password),
                    'user_type' => 'student',
                    'status' => 'active',

                ]);





                $year = date('Y');

                $lastStudent = Student::whereYear('created_at', $year)
                    ->orderBy('id', 'desc')
                    ->first();

                $nextNumber = $lastStudent
                    ? ((int) substr($lastStudent->student_id, -3)) + 1
                    : 1;

                $studentId = 'STU' . $year . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

                $profile_image = null;

                if ($request->hasFile('profile_image')) {
                    $profile_image = $request->file('profile_image')->store('profile_images', 'public');
                }

                $student = Student::create([
                    'user_id' => $user->id,
                    'student_id' => $studentId,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'age' => $request->age,
                    'nic_number' => $request->nic_number,

                    'phone_number' => $request->phone_number,
                    'whatsapp_number' => $request->whatsapp_number,
                    'email' => $request->email,
                    'address' => $request->address,

                    'parent_guardian_name' => $request->parent_guardian_name,
                    'relationship' => $request->relationship,
                    'parent_phone' => $request->parent_phone,
                    'parent_email' => $request->parent_email,
                    'parent_address' => $request->parent_address,
                    'login_email' => $request->login_email,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'profile_image' => $profile_image,
                ]);


                if ($request->course && $request->batch) {
                    Enrollment::create([
                        'student_id' => $student->id,
                        'course_id'  => $request->course,
                        'batch_id'   => $request->batch,
                        'enrolled_date' => $request->enrolled_date,

                    ]);
                }
            });
        } catch (\Exception $e) {
            return $e;
        }
        return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);


        $courses = Course::all();
        $batches = Batch::all();


        return view('admin.students.update', compact('student', 'courses', 'batches'));
    }


    public function update(Request $request, $id)
    {
        $student = Student::with('user')->findOrFail($id);
        $user = $student->user;

        $request->validate([

            'username'    => 'required|unique:users,username,' . $user->id,
            'login_email' => 'required|email|unique:users,login_email,' . $user->id,
            'password'    => 'nullable|min:8',


            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'nullable|in:male,female,other',
            'dob'         => 'nullable|date',
            'age'         => 'nullable|integer|min:0',
            'nic_number'  => 'nullable|unique:students,nic_number,' . $student->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'course' => 'required|exists:courses,id',
            'batch'  => 'required|exists:batches,id',

        ]);

        DB::transaction(function () use ($request, $student, $user) {


            $userData = [
                'username'    => $request->username,
                'login_email' => $request->login_email,
                'status'      => $request->status ?? $user->status,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);


            if ($request->course && $request->batch) {
                $enrollment = Enrollment::firstOrCreate(
                    ['student_id' => $student->id],
                    [
                        'course_id' => $request->course,
                        'batch_id' => $request->batch,
                        'enrolled_date' => $request->enrolled_date,

                    ]
                );


                $enrollment->update([
                    'course_id' => $request->course,
                    'batch_id' => $request->batch,
                    'enrolled_date' => $request->enrolled_date ?? $enrollment->enrolled_date,
                    'status' => $request->status ?? $enrollment->status
                ]);
            }


            $profileImage = $student->profile_image;

            if ($request->hasFile('profile_image')) {
                $profileImage = $request->file('profile_image')
                    ->store('profile_images', 'public');
            }


            $student->update([
                'first_name'           => $request->first_name,
                'last_name'            => $request->last_name,
                'gender'               => $request->gender,
                'dob'                  => $request->dob,
                'age'                  => $request->age,
                'nic_number'           => $request->nic_number,
                'phone_number'         => $request->phone_number,
                'whatsapp_number'      => $request->whatsapp_number,
                'email'                => $request->email,
                'address'              => $request->address,
                'course_id'            => $request->course,
                'batch_id'             => $request->batch,
                'enrollment_date'      => $request->enrollment_date,
                'status'               => $request->status,
                'parent_guardian_name' => $request->parent_guardian_name,
                'relationship'         => $request->relationship,
                'parent_phone'         => $request->parent_phone,
                'parent_email'         => $request->parent_email,
                'parent_address'       => $request->parent_address,
                'profile_image'        => $profileImage,
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }



    public function delete($id)
    {
        try {
            Student::query()->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function show($id)
    {
        $student = Student::with('enrollments.course', 'enrollments.batch')
            ->findOrFail($id);

        $courses = Course::where('status', 'active')->get();
        $batches = Batch::where('status', 'active')->get();

        return view('admin.students.view', compact(
            'student',
            'courses',
            'batches'
        ));
    }
}
