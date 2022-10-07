<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountTypeController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware('guest:admin')->group(function () {

    // for admin login
    Route::get('login', [AdminAuthController::class, 'AdminLogin'])->name('AdminLogin');
    Route::post('login', [AdminAuthController::class, 'AdminLoginPost'])->name('AdminLogin.Post');

    // for admin register
    Route::get('register', [AdminAuthController::class, 'AdminRegister'])->name('AdminRegister');
    Route::post('register', [AdminAuthController::class, 'AdminRegisterPost'])->name('AdminRegister.Post');
});

Route::middleware('auth:admin')->group(function () {
    // logout route
    Route::post('logout', [AdminAuthController::class, 'AdminLogOut'])->name('AdminLogOut');

    // dashborad route
    Route::get('dashboard', [DashboardController::class, 'DashboardView'])->name('BackendDashboardView');

    // for all transaction  route
    Route::get('transactions', [DashboardController::class, 'AllTranaction'])->name('AllTranaction');

    // account type create,edit,update route
    Route::resource('accounttype', AccountTypeController::class);
});
