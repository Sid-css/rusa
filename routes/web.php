<?php

use App\Http\Controllers\Auth\LoginController;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', fn() => view('home'))->name('home');
});

use App\Http\Controllers\Auth\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

use App\Http\Controllers\Admin\AdminDashboardController;
//use App\Http\Controllers\Institution\InstitutionDashboardController;

Route::middleware(['auth','admin'])
    ->get('/admin/dashboard', [AdminDashboardController::class,'index'])
    ->name('admin.dashboard');



// Redirect root to login
Route::get('/', fn() => redirect()->route('login'));


