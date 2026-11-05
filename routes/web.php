<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\FavouriteController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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
    ->name('pages.auth.logout');

// Authenticated customer routes
Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [CustomerAuthController::class, 'logout'])
        ->name('logout');

    // Favorites / Wishlist
    Route::get('/favorites', [FavouriteController::class, 'index'])
        ->name('pages.fav.index');
    Route::post('/favorites', [FavouriteController::class, 'store'])
        ->name('pages.fav.store');
    Route::delete('/favorites/{id}', [FavouriteController::class, 'destroy'])
        ->name('pages.fav.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('pages.cart.index');
    Route::post('/cart', [CartController::class, 'store'])
        ->name('pages.cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])
        ->name('pages.cart.destroy');

    // Addresses
    Route::get('/account/addresses', [AddressController::class, 'index'])
        ->name('customer.addresses.index');
    Route::post('/account/addresses', [AddressController::class, 'store'])
        ->name('customer.addresses.store');
    Route::delete('/account/addresses/{address}', [AddressController::class, 'destroy'])
        ->name('customer.addresses.destroy');

    // Orders
    Route::get('/account/orders', [OrderController::class, 'index'])
        ->name('customer.orders.index');
    Route::post('/account/orders', [OrderController::class, 'store'])
        ->name('customer.orders.store');
    Route::get('/account/orders/{order}', [OrderController::class, 'show'])
        ->name('customer.orders.show');

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('customer.reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('customer.reviews.destroy');
});

// Product routes
Route::get('/products', [ProductController::class, 'index'])
    ->name('pages.products.view');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('pages.products.show');

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
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])
            ->name('dashboard');

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');

        Route::middleware('admin.role')->group(function () {
            Route::view('/settings', 'admin.settings.index')
                ->name('settings');

            Route::get('/hero', [HeroSectionController::class, 'edit'])
                ->name('hero.edit');

            Route::put('/hero', [HeroSectionController::class, 'update'])
                ->name('hero.update');
        });
    });
});
