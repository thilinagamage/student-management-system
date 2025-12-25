<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\People\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(){
            // Paginate 10 students per page
    $students = Student::with('user')->latest()->paginate(10);
        return view('admin.index', compact('students'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
       try{
             $request->validate([
            //User account validation
            'username' => 'required|unique:users,username',
            'login_email' => 'required|email|unique:users,login_email',
            'password' => 'required|min:8',

            //Students Fields
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer|min:0',
            'nic_number' => 'nullable|string|unique:students,nic_number',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',


        ]);

        DB::transaction(function() use($request){

            //Create user account
            $user = User::create([
                'username' => $request->username,
                'login_email' => $request->login_email,
                'password' => Hash::make($request->password),
                'user_type' => 'student',
                'status' => 'active',

            ]);

            //Generate student ID
            $studentID = 'STU' .date('Y') . '-' . str_pad(Student::count() + 1, 3, '0', STR_PAD_LEFT);

            $profile_image = null;

            if ($request->hasFile('profile_image')) {
                $profile_image = $request->file('profile_image')->store('profile_images', 'public');
            }
                    //Create student record
            Student::create([
                'user_id' => $user->id,
                'student_id' => $studentID,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'age' => $request->age,
                'nic_number' => $request->nic_number,
                'student_id' => $studentID,
                'phone_number' => $request->phone_number,
                'whatsapp_number' => $request->whatsapp_number,
                'email' => $request->email,
                'address' => $request->address,
                'course' => $request->course,
                'batch' => $request->batch,
                'enrollment_date' => $request->enrollment_date,
                'status' => $request->status,
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
        });
       }
       catch(\Exception $e){
            return $e;
       }
        return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');


    }

    public function edit($id){
        try{
            $student = Student::query()->where('id', $id)->first();
            return view('admin.update', compact('student'));
        }
        catch(\Exception $e){
            return $e;
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::with('user')->findOrFail($id);
        $user = $student->user;

        $request->validate([
            // User table
            'username'    => 'required|unique:users,username,' . $user->id,
            'login_email' => 'required|email|unique:users,login_email,' . $user->id,
            'password'    => 'nullable|min:8',

            // Student table
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'nullable|in:male,female,other',
            'dob'         => 'nullable|date',
            'age'         => 'nullable|integer|min:0',
            'nic_number'  => 'nullable|unique:students,nic_number,' . $student->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function () use ($request, $student, $user) {

            /** -----------------------
             * Update USERS table
             * ---------------------- */
            $userData = [
                'username'    => $request->username,
                'login_email' => $request->login_email,
                'status'      => $request->status ?? $user->status,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            /** -----------------------
             * Profile image handling
             * ---------------------- */
            $profileImage = $student->profile_image;

            if ($request->hasFile('profile_image')) {
                $profileImage = $request->file('profile_image')
                                    ->store('profile_images', 'public');
            }

            /** -----------------------
             * Update STUDENTS table
             * ---------------------- */
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
                'course'               => $request->course,
                'batch'                => $request->batch,
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



    public function delete($id){
        try{
            Student::query()->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Student deleted successfully.');
        }
        catch(\Exception $e){
            return $e;
        }
    }

    public function show($id){
        try{
            $student = Student::query()->where('id', $id)->first();
            return view('admin.view', compact('student'));
        }
        catch(\Exception $e){
            return $e;
        }
    }


}
