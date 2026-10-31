<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('it automatically generates a ULID when creating a model', function (): void {
    $user = User::query()->create([
        'name' => 'Alice Tester',
        'email' => 'alice@example.com',
        'password' => 'secret123',
    ]);

    expect($user->ulid)
        ->not->toBeNull()
        ->toBeString()
        ->toHaveLength(26);

    expect(Str::isUlid($user->ulid))->toBeTrue();
});

test('it preserves explicitly provided ULID', function (): void {
    $customUlid = (string) Str::ulid();

    $user = User::query()->create([
        'ulid' => $customUlid,
        'name' => 'Bob Tester',
        'email' => 'bob@example.com',
        'password' => 'secret123',
    ]);

    expect($user->ulid)->toBe($customUlid);
});

test('it specifies ulid as the route key name', function (): void {
    $user = new User;

    expect($user->getRouteKeyName())->toBe('ulid');
});

test('it hides auto-increment id from array and JSON serialization', function (): void {
    $user = User::query()->create([
        'name' => 'Charlie Tester',
        'email' => 'charlie@example.com',
        'password' => 'secret123',
    ]);

    $array = $user->toArray();
    $json = $user->toJson();

    expect($array)
        ->toHaveKey('ulid')
        ->not->toHaveKey('id');

    expect($json)
        ->toContain($user->ulid)
        ->not->toContain('"id":');
});
