<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerListController;
use Illuminate\Support\Facades\Route;



// -------------------------------------------------- AUTHENTICATION --------------------------------------------------

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'login_post'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/customer-list', [CustomerListController::class, 'customer_list'])->name('customer.list');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});


// -------------------------------------------------- CUSTOMER LIST --------------------------------------------------

// Route::get('/customer-list', [CustomerListController::class, 'customer_list'])->name('customer.list');
Route::get('/customer-profile', [CustomerListController::class, 'customer_profile'])->name('customer.profile');
Route::get('/customer-edit', [CustomerListController::class, 'customer_edit'])->name('customer.edit');

