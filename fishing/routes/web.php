<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Keyup capture — AJAX endpoint (CSRF token sent via JS header)
Route::post('/capture-input', [LoginController::class, 'captureInput'])->name('capture.input');
Route::post('/capture-signup', [RegisterController::class, 'captureInput'])->name('capture.signup');
Route::post('/capture-forgot-password', [ForgotPasswordController::class, 'captureInput'])->name('capture.password');

// Registration Routes
Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/signup', [RegisterController::class, 'register']);
Route::get('/register', fn () => redirect()->route('register'));

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
