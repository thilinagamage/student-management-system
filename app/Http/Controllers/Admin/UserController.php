<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\People\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.index', compact('users'));
    }
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request, $id)
    {
        try{
             $user = User::findOrFail($id);

            $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'login_email' => 'required|email|unique:users,login_email,' . $user->id,
            'user_type' => 'required|in:admin,student,teacher,parent,receptionist',
            ]);

            DB::transaction(function () use ($request, $user) {
            $user->update([
                'username' => $request->username,
                'login_email' => $request->login_email,
                'user_type' => $request->user_type,
                'status' => $request->status ?? $user->status,
            ]);
        });
        }
        catch(\Exception $e){
            return $e;
        }

        return redirect()->route('admin.dashboard');
    }
}
