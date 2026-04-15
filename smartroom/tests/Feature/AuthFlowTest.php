<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('can sign up a new user', function () {
    $response = post('/signup', [
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'email' => 'jane@example.com',
        'password' => 'Passw0rd!',
        'password_confirmation' => 'Passw0rd!',
        'terms' => 'on',
    ]);

    $response->assertRedirect(route('faculty.dashboard'));

    assertDatabaseHas('users', [
        'email' => 'jane@example.com',
        'name' => 'Jane Doe',
    ]);

    assertAuthenticated();
});

it('can sign in an existing user', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => Hash::make('Passw0rd!'),
    ]);

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'Passw0rd!',
    ]);

    $response->assertRedirect(route('faculty.dashboard'));
    assertAuthenticatedAs($user);
});

it('redirects admin users to admin dashboard on login', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('Passw0rd!'),
        'role' => 'admin',
    ]);

    $response = post('/login', [
        'email' => $admin->email,
        'password' => 'Passw0rd!',
    ]);

    $response->assertRedirect(route('admin.schedule'));
    assertAuthenticatedAs($admin);
});

it('redirects mixed-case admin roles to admin dashboard on login', function () {
    $admin = User::create([
        'name' => 'Admin Mixed Case',
        'email' => 'admin.mixed@example.com',
        'password' => Hash::make('Passw0rd!'),
        'role' => 'Admin',
    ]);

    $response = post('/login', [
        'email' => $admin->email,
        'password' => 'Passw0rd!',
    ]);

    $response->assertRedirect(route('admin.schedule'));
    assertAuthenticatedAs($admin);
});

it('does not redirect non-admin roles that contain admin text', function () {
    $facultyLike = User::create([
        'name' => 'Faculty Admin Assistant',
        'email' => 'faculty.admin.assistant@example.com',
        'password' => Hash::make('Passw0rd!'),
        'role' => 'faculty_admin_assistant',
    ]);

    $response = post('/login', [
        'email' => $facultyLike->email,
        'password' => 'Passw0rd!',
    ]);

    $response->assertRedirect(route('faculty.dashboard'));
    assertAuthenticatedAs($facultyLike);
});

it('blocks faculty from admin pages', function () {
    $faculty = User::create([
        'name' => 'Faculty User',
        'email' => 'faculty@example.com',
        'password' => Hash::make('Passw0rd!'),
        'role' => 'faculty',
    ]);

    actingAs($faculty)
        ->get('/dashboard')
        ->assertForbidden();
});
