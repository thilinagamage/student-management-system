<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_email' => 'required|email',
            'password'    => 'required',
        ]);

        $credentials = [
            'login_email' => $request->login_email,
            'password'    => $request->password,
            'status'      => 'active',
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->user_type) {
                'admin'        => redirect()->route('admin.dashboard'),
                'teacher'      => redirect()->route('teacher.dashboard'),
                'student'      => redirect()->route('student.dashboard'),
                'receptionist' => redirect()->route('reception.dashboard'),
                default        => $this->logoutAndRedirect($request),
            };
        }

        return back()->withErrors([
            'login_error' => 'Invalid email or password.',
        ]);
    }

    public function logoutAndRedirect(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
