<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Academic\Batch;
use App\Models\People\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    public function dashboard(){
        return view('teacher.dashboard');
    }


    public function index()
    {
     // Paginate 10 teachers per page
        $teachers = Teacher::with('user')->latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
       try{
         $request->validate([
            'username' => 'required|unique:users,username',
            'login_email' => 'required|email|unique:users,login_email',
            'password' => 'required|min:8',
            'dob' => 'required|date',
            'nic_number' => 'required|unique:teachers,nic_number',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'username' => $request->username,
                'login_email' => $request->login_email,
                'password' => Hash::make($request->password),
                'user_type' => 'teacher',
                'status' => 'active',
            ]);

            $teacherCode = 'TCH' . date('Y') . '-' . str_pad(Teacher::count() + 1, 3, '0', STR_PAD_LEFT);


            $profile_image = null;

            if ($request->hasFile('profile_image')) {
                $profile_image = $request->file('profile_image')->store('profile_images', 'public');
            }

            Teacher::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'teacher_code' => $teacherCode,
                'nic_number' => $request->nic_number,
                'phone' => $request->phone,
                'whatsapp_number' => $request->whatsapp_number,
                'email' => $request->login_email,
                'address' => $request->address,
                'joined_date' => $request->joined_date,
                'status' => 'active',
                'username' => $request->username,
                'login_email' => $request->login_email,
                'password' => Hash::make($request->password),
                'profile_image' => $profile_image,
            ]);
        });

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully');
       }
            catch(\Exception $e){
            return $e;
        }
    }

    public function edit($id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'login_email' => 'required|email|unique:users,login_email,' . $user->id,
            'dob' => 'required|date',
            'nic_number' => 'required|unique:teachers,nic_number,' . $teacher->id,
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        DB::transaction(function () use ($request, $teacher, $user) {
            $user->update([
                'username' => $request->username,
                'login_email' => $request->login_email,
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $teacher->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'nic_number' => $request->nic_number,
                'phone' => $request->phone,
                'whatsapp_number' => $request->whatsapp_number,
                'email' => $request->login_email,
                'address' => $request->address,
                'joined_date' => $request->joined_date,
            ]);
        });

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully');
    }


    public function delete($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        DB::transaction(function () use ($teacher, $user) {
            $teacher->delete();
            $user->delete();
        });

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    }

    public function view($id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.teachers.view', compact('teacher'));
    }




}
