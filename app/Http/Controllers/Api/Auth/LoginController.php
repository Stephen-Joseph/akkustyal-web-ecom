<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\AuthenticateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * Handle user login.
     */
    public function __invoke(LoginRequest $request, AuthenticateUserAction $action): JsonResponse
    {
        $credentials = $request->validated();

        $result = $action->execute(
            email: (string) $credentials['email'],
            password: (string) $credentials['password'],
            deviceName: isset($credentials['device_name']) ? (string) $credentials['device_name'] : null,
        );

        return response()->json([
            'token' => $result['token'],
            'user' => new UserResource($result['user']),
        ]);
    }
}
