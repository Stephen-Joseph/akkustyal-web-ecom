<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Admin\AdminAuthController;

Route::get('/', function () {
    return view('index');
});

// Customer authentication routes

Route::get('/register', [CustomerAuthController::class, 'showRegister'])
    ->middleware('guest:customer')
    ->name('pages.auth.register');

Route::post('/register', [CustomerAuthController::class, 'register'])
    ->middleware('guest:customer')
    ->name('pages.auth.register.submit');

Route::get('/login', [CustomerAuthController::class, 'showLogin'])
    ->middleware('guest:customer')
    ->name('pages.auth.login');

Route::post('/login', [CustomerAuthController::class, 'login'])
    ->middleware('guest:customer')
    ->name('pages.auth.login.submit');

Route::post('/logout', [CustomerAuthController::class, 'logout'])
    ->middleware('auth:customer')
    ->name('customer.logout');

// Authenticated customer routes
Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [CustomerAuthController::class, 'logout'])
        ->name('logout');
});


// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

    // Protected Admin Pages
    Route::middleware('auth:admin')->group(function () {

        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');

    });

});