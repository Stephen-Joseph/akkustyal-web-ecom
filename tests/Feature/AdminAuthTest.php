<?php

declare(strict_types=1);

use App\Models\Admin;

function createAdmin(array $attributes = []): Admin
{
    return Admin::create([
        'username' => 'admin',
        'name' => 'Store Admin',
        'email' => 'admin@example.com',
        'password' => 'secret-password',
        'role' => 'admin',
        ...$attributes,
    ]);
}

test('the admin login page renders', function (): void {
    $this->get(route('admin.login'))
        ->assertOk()
        ->assertSee('name="login"', false)
        ->assertSee(route('admin.login.submit'), false);
});

test('guests visiting admin pages are redirected to the admin login', function (string $routeName): void {
    $this->get(route($routeName))->assertRedirect(route('admin.login'));
})->with(['admin.dashboard', 'admin.settings', 'admin.hero.edit']);

test('an admin can log in with an email or a username', function (string $login): void {
    $admin = createAdmin();

    $this->post(route('admin.login.submit'), [
        'login' => $login,
        'password' => 'secret-password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($admin, 'admin');
})->with(['admin@example.com', 'admin']);

test('login fails with invalid credentials', function (): void {
    createAdmin();

    $this->from(route('admin.login'))
        ->post(route('admin.login.submit'), [
            'login' => 'admin@example.com',
            'password' => 'wrong-password',
        ])
        ->assertRedirect(route('admin.login'))
        ->assertSessionHasErrors('login');

    $this->assertGuest('admin');
});

test('a logged in admin can view the dashboard', function (): void {
    $admin = createAdmin();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Welcome, Store Admin')
        ->assertSee(route('admin.logout'), false);
});

test('an admin can log out', function (): void {
    $admin = createAdmin();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.logout'))
        ->assertRedirect(route('admin.login'));

    $this->assertGuest('admin');
});

test('the settings page links to the available settings sections', function (): void {
    $this->actingAs(createAdmin(), 'admin')
        ->get(route('admin.settings'))
        ->assertOk()
        ->assertSee('Homepage Hero')
        ->assertSee(route('admin.hero.edit'), false)
        ->assertSee('Coming soon');
});

test('the hero editor is shown inside the settings section', function (): void {
    $this->actingAs(createAdmin(), 'admin')
        ->get(route('admin.hero.edit'))
        ->assertOk()
        ->assertSee(route('admin.settings'), false)
        ->assertSee(route('admin.hero.update'), false);
});

test('settings pages are restricted to the admin role', function (string $routeName, string $role, int $expectedStatus): void {
    $admin = createAdmin(['role' => $role]);

    $this->actingAs($admin, 'admin')
        ->get(route($routeName))
        ->assertStatus($expectedStatus);
})->with(['admin.settings', 'admin.hero.edit'])->with([
    'admin role' => ['admin', 200],
    'other role' => ['editor', 403],
]);
