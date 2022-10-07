<?php

use App\Http\Controllers\Frontend\AgentTransactionController;
use App\Http\Controllers\Frontend\PersonalAccountTransactinController;
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UserProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return redirect()->route('LoginView');
})->name('RegisterView')->middleware('guest:web');

Route::get('/login', [AuthController::class, 'LoginView'])->name('LoginView')->middleware('guest:web');
Route::post('/login', [AuthController::class, 'LoginPost'])->name('LoginPost')->middleware('throttle:5,360');
Route::post('/register', [AuthController::class, 'RegisterPost'])->name('RegisterPost')->middleware('guest:web');

Route::get('/code', [AuthController::class, 'AuthCodeVerify'])->name('AuthCodeVerify')->middleware('auth:web');
Route::post('/code', [AuthController::class, 'AuthCodeVerifyPost'])->name('AuthCodeVerifyPost')->middleware('auth:web');

Route::middleware('auth:web', 'authremember')->group(function () {


    Route::middleware('AgentAccount')->group(function () {
        // for cash in to personal account from agent
        Route::get('/cash-in', [AgentTransactionController::class, 'CashInView'])->name('CashInView');
        Route::post('/cash-in', [AgentTransactionController::class, 'CashInPost'])->name('CashInPost');
    });

    Route::middleware('PersonalAccount')->group(function () {
        // for add money to personal account
        Route::get('/add-money', [PersonalAccountTransactinController::class, 'AddMoney'])->name('AddMoney');
        Route::post('/add-money', [PersonalAccountTransactinController::class, 'AddMoneyPost'])->name('AddMoneyPost');
        // for send money to personal account
        Route::get('/send-money', [PersonalAccountTransactinController::class, 'SendMoneyView'])->name('SendMoneyView');
        Route::post('/send-money', [PersonalAccountTransactinController::class, 'SendMoneyPost'])->name('SendMoneyPost');

        // for cashout to agent account
        Route::get('/cashout', [PersonalAccountTransactinController::class, 'CashOutView'])->name('CashOutView');
        Route::post('/cashout', [PersonalAccountTransactinController::class, 'CashOutViewpost'])->name('CashOutViewpost');
    });

    Route::get('/dashboard', [FrontendController::class, 'DashboardView'])->name('DashboardView');
    Route::get('/transaction', [FrontendController::class, 'TransactionView'])->name('TransactionView');

    Route::get('/profile', [UserProfileController::class, 'ProfileView'])->name('ProfileView');

    Route::post('/logout', [AuthController::class, 'Logout'])->name('Logout');
});
