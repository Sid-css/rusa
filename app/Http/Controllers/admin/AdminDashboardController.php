<?php
// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Show the dashboard and handle Institution form submission
     */
    public function dashboard(Request $request)
    {
        // Stats for top of page
        $institutionsCount = Institution::count();
        $usersCount        = User::where('role','institution')->count();

        // If POST, validate & store new institution + its admin
        if ($request->isMethod('post')) {
            $data = $request->all();

            $validator = Validator::make($data, [
                'institution_name' => 'required|string|max:255|unique:institutions,name',
                'description'      => 'nullable|string',
                'institution_type' => 'required|string|max:100',
                'address'          => 'required|string|max:255',
                'city'             => 'required|string|max:100',
                'state'            => 'required|string|max:100',
                'contact_number'   => 'required|string|max:20',
                'institution_email'=> 'required|email|unique:institutions,email',
                'institution_code' => 'required|string|unique:institutions,institution_code',
                'admin_name'       => 'required|string|max:255',
                'admin_email'      => 'required|email|unique:users,email',
                'password'         => 'required|string|min:6|confirmed',
                'is_active'        => 'boolean',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with(compact('institutionsCount','usersCount'));
            }

            // Create institution
            $institution = Institution::create([
                'name'             => $data['institution_name'],
                'description'      => $data['description'],
                'institution_type' => $data['institution_type'],
                'address'          => $data['address'],
                'city'             => $data['city'],
                'state'            => $data['state'],
                'contact_number'   => $data['contact_number'],
                'email'            => $data['institution_email'],
                'institution_code' => $data['institution_code'],
                'is_active'        => $data['is_active'] ?? false,
            ]);

            // Create institution admin user
            User::create([
                'name'           => $data['admin_name'],
                'email'          => $data['admin_email'],
                'password'       => Hash::make($data['password']),
                'role'           => 'institution',
                'institution_id' => $institution->id,
            ]);

            return redirect()
                ->route('admin.dashboard')
                ->with('success','Institution added successfully');
        }

        // GET: show dashboard + form
        return view('admin.dashboard', compact('institutionsCount','usersCount'));
    }
}
