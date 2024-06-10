<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerListController;
use Illuminate\Support\Facades\Route;



// -------------------------------------------------- AUTHENTICATION --------------------------------------------------

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login_post'])->name('login.post');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/customer/list', [CustomerListController::class, 'customer_list'])->name('customer.list');
    Route::get('/customer/{encryptedId}/profile', [CustomerListController::class, 'customer_profile'])->name('customer.profile');
    Route::get('/customer/{encryptedId}/edit', [CustomerListController::class, 'customer_edit'])->name('customer.edit');
    Route::put('/customer/{encryptedId}', [CustomerListController::class, 'customer_update'])->name('customer.update');
    Route::get('/search', [CustomerListController::class, 'handle_search'])->name('search');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
