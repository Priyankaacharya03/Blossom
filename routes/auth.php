<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('addUser', [AuthController::class, 'registerSubmit'])->name('register.submit');



Route::prefix('vendor')->as('vendor.')->group(function () {
    Route::get('/register', [AuthController::class, 'vendorRegister'])->name('register');
});

// Email Verification Notice Route

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Route::get('/profile', function () {
//     // Only verified users may access this route...
// })->middleware(['auth', 'verified']);


//verify email 
Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/verify', [AuthController::class, 'verifyOTP'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOTP'])->name('resend.otp');



//password reset
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'PasswordEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'PasswordReset'])->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'PasswordUpdate'])->name('password.update');


//googleauth
Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);
