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
        return view('admin.manage_students');
    }

    public function create(){
        return view('admin.add_student');
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

            //Create student record
            Student::create([
                'user_id' => $user->id,
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
                'profile_image'      => $request->profile_image,
            ]);
        });
       }
       catch(\Exception $e){
            return $e;
       }
        return redirect()->route('admin.managestudent')->with('success', 'Student added successfully.');


    }
}
