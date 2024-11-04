<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\OtpCheckController;
use App\Http\Controllers\auth\ResetPasswordController;

Route::controller(JWTAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('email/verify/{id}', 'verify')->name('verification.verify');
});

Route::post('forget/password',  ForgotPasswordController::class);
Route::post('password/otp/check', OtpCheckController::class);
Route::post('reset/password', ResetPasswordController::class);