<?php

use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\PersonalAccountTransactinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return redirect()->route('LoginView');
});
Route::get('/register', function () {
    return redirect()->route('LoginView');
})->name('RegisterView');

Route::get('/login', [AuthController::class, 'LoginView'])->name('LoginView');
// Route::post('/login', [AuthController::class, 'LoginPost'])->name('LoginPost')->middleware('throttle:5,6');
Route::post('/login', [AuthController::class, 'LoginPost'])->name('LoginPost');
Route::post('/register', [AuthController::class, 'RegisterPost'])->name('RegisterPost');

Route::get('/code', [AuthController::class, 'AuthCodeVerify'])->name('AuthCodeVerify');
Route::post('/code', [AuthController::class, 'AuthCodeVerifyPost'])->name('AuthCodeVerifyPost');

Route::middleware('auth:web', 'authremember')->group(function () {

    Route::get('/add-money', [PersonalAccountTransactinController::class, 'AddMoney'])->name('AddMoney');
    Route::post('/add-money', [PersonalAccountTransactinController::class, 'AddMoneyPost'])->name('AddMoneyPost');

    Route::get('/send-money', [PersonalAccountTransactinController::class, 'SendMoneyView'])->name('SendMoneyView');
    Route::post('/send-money', [PersonalAccountTransactinController::class, 'SendMoneyPost'])->name('SendMoneyPost');

    Route::get('/cashout', [PersonalAccountTransactinController::class, 'CashOutView'])->name('CashOutView');
    Route::post('/cashout', [PersonalAccountTransactinController::class, 'CashOutViewpost'])->name('CashOutViewpost');

    Route::get('/dashboard', [FrontendController::class, 'DashboardView'])->name('DashboardView');
    Route::get('/transaction', [FrontendController::class, 'TransactionView'])->name('TransactionView');

    Route::get('/profile', [UserProfileController::class, 'ProfileView'])->name('ProfileView');

    Route::post('/logout', [AuthController::class, 'Logout'])->name('Logout');
});
