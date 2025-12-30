<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function permissions(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.admin.permissions', compact('admin','permissions'));
    }

    public function updatePermissions(Request $request, User $admin)
    {
        $admin->permissions()->sync($request->permissions ?? []);
        return back()->with('success','Permissions updated');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function studentDashboard(){
        return view('student.dashboard');
    }

      public function index()
    {
        $admins = User::where('user_type', 'admin')->latest()->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'     => 'required|string|max:100',
            'login_email'  => 'required|email|unique:users,login_email',
            'password'     => 'required|min:6|confirmed',
        ]);

        User::create([
            'username'   => $request->username,
            'login_email'=> $request->login_email,
            'password'   => Hash::make($request->password),
            'user_type'  => 'admin',
            'status'     => 'active',
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin created successfully');
    }

    public function edit(User $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'username'    => 'required|string|max:100',
            'login_email' => 'required|email|unique:users,login_email,' . $admin->id,
            'password'    => 'nullable|min:6|confirmed',
            'status'      => 'required|in:active,inactive',
        ]);

        $admin->update([
            'username'    => $request->username,
            'login_email' => $request->login_email,
            'status'      => $request->status,
        ]);

        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin updated successfully');
    }

    public function destroy(User $admin)
    {
        if ($admin->id === auth()->id()) {
            return back()->withErrors('You cannot delete your own account.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin deleted successfully');
    }

        public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username'    => 'required|string|max:100',
            'login_email' => 'required|email|unique:users,login_email,' . $user->id,
            'password'    => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'username'    => $request->username,
            'login_email' => $request->login_email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return back()->with('success', 'Profile updated successfully');
    }

}
