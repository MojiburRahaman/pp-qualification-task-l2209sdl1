<?php

use App\Http\Controllers\Admin\AccountTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware('guest:admin')->group(function () {

    Route::get('login', [AdminAuthController::class, 'AdminLogin'])->name('AdminLogin');
    Route::post('login', [AdminAuthController::class, 'AdminLoginPost'])->name('AdminLogin.Post');

    Route::get('register', [AdminAuthController::class, 'AdminRegister'])->name('AdminRegister');
    Route::post('register', [AdminAuthController::class, 'AdminRegisterPost'])->name('AdminRegister.Post');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('logout', [AdminAuthController::class, 'AdminLogOut'])->name('AdminLogOut');
    
    Route::get('dashboard', [DashboardController::class, 'DashboardView'])->name('DashboardView');

    Route::resource('accounttype', AccountTypeController::class);
});
