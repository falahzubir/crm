<?php

use App\Http\Controllers\CustomerListController;
use Illuminate\Support\Facades\Route;


// -------------------------------------------------- AUTHENTICATION --------------------------------------------------

Route::get('/', [AuthController::class, 'index'])->name('auth.login');



// -------------------------------------------------- CUSTOMER LIST --------------------------------------------------

Route::get('/customer-list', [CustomerListController::class, 'index'])->name('customer-list');
Route::get('/customer-profile', [CustomerListController::class, 'customer_profile'])->name('customer-profile');

