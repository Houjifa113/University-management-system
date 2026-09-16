<?php

namespace App\Http\Controllers;

use App\Models\user_role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'identifier' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $credentials['identifier'],
            'password' => $credentials['password'],
            'role_id' => user_role::ADMIN_ID,
        ])) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('web')->attempt([
            'email' => $credentials['identifier'],
            'password' => $credentials['password'],
            'role_id' => user_role::TEACHER_ID,
        ])) {
            $request->session()->regenerate();

            return redirect()->route('teacher.profile', Auth::guard('web')->id());
        }

        if (Auth::guard('student')->attempt([
            'email' => $credentials['identifier'],
            'password' => $credentials['password'],
            'role_id' => user_role::STUDENT_ID,
        ])) {
            $request->session()->regenerate();

            return redirect()->route('student.profile', Auth::guard('student')->id());
        }

        return back()->withErrors([
            'identifier' => 'The credentials do not match any records.',
        ])->onlyInput('identifier');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        Auth::guard('student')->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function studentLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'identifier' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('student')->attempt([
            'email' => $credentials['identifier'],
            'password' => $credentials['password'],
            'role_id' => user_role::STUDENT_ID,
        ])) {
            $request->session()->regenerate();

            return redirect()->route('student.profile', Auth::guard('student')->id());
        }

        return back()->withErrors([
            'identifier' => 'The provided credentials do not match our records.',
        ])->onlyInput('identifier');
    }

    public function studentLogout(Request $request): RedirectResponse
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
