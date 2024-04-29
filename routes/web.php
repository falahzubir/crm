<?php

use App\Http\Controllers\CustomerListController;
use Illuminate\Support\Facades\Route;


// -------------------------------------------------- AUTHENTICATION --------------------------------------------------

// UNTUK HANDLE LOGIN
Route::get('/', [LoginController::class, 'index'])->name('login-page');
Route::post('/', [LoginController::class, 'store'])->name('submit-login');

// UNTUK HANDLE REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register-page');
Route::post('/register', [RegisterController::class, 'store'])->name('submit-register');

// UNTUK HANDLE FORGOT PASSWORD
Route::get('/reset', [PasswordController::class, 'index'])->name('forgot-page');
Route::post('/reset', [PasswordController::class, 'send'])->name('send-link');

Route::get('/user/{id}/token/{remember_token}', function ($id, $remember_token) {
    $user = User::find($id);
    $token = $remember_token;
    return view('auth.reset-password', compact('user', 'token'));
});

Route::post('/update_password', [PasswordController::class, 'update'])->name('update-password');

// UNTUK HANDLE LOGOUT
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



// -------------------------------------------------- CUSTOMER LIST --------------------------------------------------

Route::get('/customer-list', [CustomerListController::class, 'index'])->name('customer-list');

