<?php

use Illuminate\Support\Facades\Route;

use Eutranet\Setup\Http\Controllers\Auth\AuthenticatedSessionController;
use Eutranet\Setup\Http\Controllers\Auth\ConfirmablePasswordController;
use Eutranet\Setup\Http\Controllers\Auth\EmailVerificationNotificationController;
use Eutranet\Setup\Http\Controllers\Auth\EmailVerificationPromptController;
use Eutranet\Setup\Http\Controllers\Auth\NewPasswordController;
use Eutranet\Setup\Http\Controllers\Auth\PasswordResetLinkController;
use Eutranet\Setup\Http\Controllers\Auth\RegisteredUserController;
use Eutranet\Setup\Http\Controllers\Auth\VerifyEmailController;

Route::middleware(['web'])->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');

    Route::get('goodbye', function () {
        return view('welcome')->with('status', 'Goodbye');
    })->name('goodbye.user');
    Route::get('goodbye-staff', function () {
        return view('welcome')->with('status', 'Goodbye');
    })->name('goodbye.staff');
    Route::get('goodbye-admin', function () {
        return view('welcome')->with('status', 'Goodbye');
    })->name('goodbye.admin');
});

Route::middleware(['web'])->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
