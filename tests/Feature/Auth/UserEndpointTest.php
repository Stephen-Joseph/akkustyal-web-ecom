<?php

declare(strict_types=1);

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('authenticated user can access their user profile via sanctum token', function (): void {
    $user = User::factory()->create();

    Sanctum::actingAs($user, ['*']);

    $response = $this->getJson(route('api.user'));

    $response->assertOk()
        ->assertJson([
            'data' => [
                'ulid' => $user->ulid,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ])
        ->assertJsonMissing(['id' => $user->id]);
});

test('unauthenticated request to user endpoint returns 401 unauthorized', function (): void {
    $response = $this->getJson(route('api.user'));

    $response->assertUnauthorized();
});
