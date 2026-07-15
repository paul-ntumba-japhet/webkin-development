<?php

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
});

function createUserWithRoles(array $roleSlugs): User
{
    $user = User::query()->create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'user-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1999'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleIds = Role::query()->whereIn('slug', $roleSlugs)->pluck('id');
    $user->roles()->sync($roleIds);

    return $user->load('roles');
}

it('checks single and multiple roles on user', function () {
    $student = createUserWithRoles([RoleSlug::Student->value]);
    $admin = createUserWithRoles([RoleSlug::Admin->value]);

    expect($student->hasRole(RoleSlug::Student))->toBeTrue()
        ->and($student->hasRole('student'))->toBeTrue()
        ->and($student->hasRole(RoleSlug::Admin))->toBeFalse()
        ->and($student->isStudent())->toBeTrue()
        ->and($student->isStaff())->toBeFalse()
        ->and($student->isAdminAreaUser())->toBeFalse();

    expect($admin->hasAnyRole([RoleSlug::Admin, RoleSlug::Editor]))->toBeTrue()
        ->and($admin->isAdminAreaUser())->toBeTrue()
        ->and($admin->isStaff())->toBeTrue();
});

it('checks permissions via resolver on user', function () {
    $student = createUserWithRoles([RoleSlug::Student->value]);
    $admin = createUserWithRoles([RoleSlug::Admin->value]);

    expect($student->hasPermission(PermissionSlug::AssignmentsSubmit))->toBeTrue()
        ->and($student->hasPermission(PermissionSlug::UsersManage))->toBeFalse();

    expect($admin->hasPermission(PermissionSlug::UsersManage))->toBeTrue()
        ->and($admin->hasPermission('users.manage'))->toBeTrue();
});

it('grants super admin all permissions', function () {
    $superAdmin = createUserWithRoles([RoleSlug::SuperAdmin->value]);

    expect($superAdmin->hasPermission(PermissionSlug::SettingsManage))->toBeTrue()
        ->and($superAdmin->hasPermission('settings.manage'))->toBeTrue();
});

it('uses loaded roles relation without extra query for hasRole', function () {
    $student = createUserWithRoles([RoleSlug::Student->value]);

    expect($student->relationLoaded('roles'))->toBeTrue()
        ->and($student->hasRole(RoleSlug::Student))->toBeTrue();
});
