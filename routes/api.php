<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('/login', LoginController::class)
        ->middleware('throttle:6,1')
        ->name('api.auth.login');
});

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/user', function (Request $request): UserResource {
        /** @var User $user */
        $user = $request->user();

        return new UserResource($user);
    })->name('api.user');
});
