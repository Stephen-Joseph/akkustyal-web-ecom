<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('a user can log in with valid credentials and receive an API token', function (): void {
    $user = User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson(route('api.auth.login'), [
        'email' => 'john@example.com',
        'password' => 'password123',
        'device_name' => 'test-device',
    ]);

    $response->assertOk()
        ->assertJsonStructure([
            'token',
            'user' => [
                'ulid',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('user.ulid', $user->ulid)
        ->assertJsonMissing(['id' => $user->id]);

    expect($response->json('token'))->toBeString();
});

test('login fails when required fields are missing', function (): void {
    $response = $this->postJson(route('api.auth.login'), []);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['email', 'password']);
});

test('login fails when invalid credentials are provided', function (): void {
    User::factory()->create([
        'email' => 'jane@example.com',
        'password' => Hash::make('correct-password'),
    ]);

    $response = $this->postJson(route('api.auth.login'), [
        'email' => 'jane@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
});

test('public login endpoint enforces rate limiting after excessive attempts', function (): void {
    for ($i = 0; $i < 6; $i++) {
        $this->postJson(route('api.auth.login'), [
            'email' => 'spammer@example.com',
            'password' => 'invalid-password',
        ]);
    }

    $response = $this->postJson(route('api.auth.login'), [
        'email' => 'spammer@example.com',
        'password' => 'invalid-password',
    ]);

    $response->assertStatus(429);
});
