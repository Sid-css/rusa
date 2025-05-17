<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        // Only guests may access login; logout is for authenticated users
        $this->middleware('guest')->except('logout');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process the login submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

                 $user = Auth::user();

        // Now branch by role
        if ($user->role === 'admin') {
            // You could return a dashboard view directly...
            return view('admin.dashboard', ['user' => $user]);
        }

        // if ($user->role === 'institution') {
        //     return view('institution.dashboard', ['user' => $user]);
        // }


         return redirect()->intended('/home');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    // Log the user out
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
