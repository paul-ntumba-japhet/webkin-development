<?php

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);

    Route::middleware(['web', 'auth', 'role:student'])->get('/_test/student-zone', fn () => response('student-ok'));
    Route::middleware(['web', 'auth', 'role:admin,editor,super-admin'])->get('/_test/admin-zone', fn () => response('admin-ok'));
    Route::middleware(['web', 'auth:sanctum', 'permission:users.manage'])->get('/_test/manage-users', fn () => response('manage-ok'));
});

function middlewareTestUser(array $roleSlugs): User
{
    $user = User::query()->create([
        'first_name' => 'Middleware',
        'last_name' => 'Test',
        'email' => 'mw-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1888'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleIds = Role::query()->whereIn('slug', $roleSlugs)->pluck('id');
    $user->roles()->sync($roleIds);

    return $user;
}

it('allows student role middleware access', function () {
    $student = middlewareTestUser([RoleSlug::Student->value]);

    $this->actingAs($student)
        ->get('/_test/student-zone')
        ->assertOk()
        ->assertSee('student-ok');
});

it('denies student access to admin role middleware', function () {
    $student = middlewareTestUser([RoleSlug::Student->value]);

    $this->actingAs($student)
        ->get('/_test/admin-zone')
        ->assertForbidden();
});

it('allows admin role middleware access', function () {
    $admin = middlewareTestUser([RoleSlug::Admin->value]);

    $this->actingAs($admin)
        ->get('/_test/admin-zone')
        ->assertOk()
        ->assertSee('admin-ok');
});

it('denies admin access to student role middleware', function () {
    $admin = middlewareTestUser([RoleSlug::Admin->value]);

    $this->actingAs($admin)
        ->get('/_test/student-zone')
        ->assertForbidden();
});

it('allows permission middleware when user has permission', function () {
    $admin = middlewareTestUser([RoleSlug::Admin->value]);

    $this->actingAs($admin)
        ->get('/_test/manage-users')
        ->assertOk()
        ->assertSee('manage-ok');
});

it('denies permission middleware when user lacks permission', function () {
    $student = middlewareTestUser([RoleSlug::Student->value]);

    $this->actingAs($student)
        ->get('/_test/manage-users')
        ->assertForbidden();
});
