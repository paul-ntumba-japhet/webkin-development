<?php

use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
});

function apiZoneUser(string ...$roleSlugs): User
{
    $user = User::query()->create([
        'first_name' => 'Zone',
        'last_name' => 'Test',
        'email' => 'zone-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1998'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleIds = Role::query()->whereIn('slug', $roleSlugs)->pluck('id');
    $user->roles()->sync($roleIds);

    return $user;
}

it('allows student to access student api zone', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Student->value));

    $this->getJson('/api/v1/student')
        ->assertOk()
        ->assertJsonPath('zone', 'student');
});

it('denies student access to admin api zone', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Student->value));

    $this->getJson('/api/v1/admin')->assertForbidden();
});

it('allows admin staff to access admin api zone', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Admin->value));

    $this->getJson('/api/v1/admin')
        ->assertOk()
        ->assertJsonPath('zone', 'admin');
});

it('allows editor to access admin api zone', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Editor->value));

    $this->getJson('/api/v1/admin')->assertOk();
});

it('denies admin access to student api zone', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Admin->value));

    $this->getJson('/api/v1/student')->assertForbidden();
});

it('allows admin with users manage permission to list users endpoint', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Admin->value));

    $this->getJson('/api/v1/admin/users')
        ->assertOk()
        ->assertJsonPath('resource', 'users');
});

it('denies student access to admin users endpoint', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Student->value));

    $this->getJson('/api/v1/admin/users')->assertForbidden();
});

it('denies editor without users manage from admin users endpoint', function () {
    Sanctum::actingAs(apiZoneUser(RoleSlug::Editor->value));

    $this->getJson('/api/v1/admin/users')->assertForbidden();
});
