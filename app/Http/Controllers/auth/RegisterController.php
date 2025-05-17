<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // If needed, pass institution list to register form
        $institutions = Institution::all();
        return view('auth.register', compact('institutions'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        auth()->login($user);

        return redirect()->route('home'); // Adjust as needed
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'in:admin,institution'],
            // 'institution_id' => ['nullable', 'exists:institutions,id'],
            
            
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            // 'institution_id' => $data['name'] ?? null,
        ]);
    }
}
