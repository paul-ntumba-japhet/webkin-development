<?php

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\IdentityAccess\Services\PostLoginRedirectResolver;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->withoutMiddleware(ValidateCsrfToken::class);
});

function authExtensionUser(string $roleSlug): User
{
    $user = User::query()->create([
        'first_name' => 'Api',
        'last_name' => 'User',
        'email' => 'api-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1444'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleId = Role::query()->where('slug', $roleSlug)->value('id');
    $user->roles()->sync([$roleId]);

    return $user;
}

it('returns permissions and dashboard path on login for student', function () {
    $user = authExtensionUser(RoleSlug::Student->value);

    $this->postJson('/api/v1/login', [
        'email' => $user->email,
        'password' => 'password-123',
        'remember' => false,
    ])
        ->assertOk()
        ->assertJsonPath('data.dashboard_path', PostLoginRedirectResolver::STUDENT_HOME)
        ->assertJsonFragment(['slug' => RoleSlug::Student->value])
        ->assertJsonFragment([PermissionSlug::AssignmentsSubmit->value]);
});

it('returns admin dashboard path and permissions on login', function () {
    $user = authExtensionUser(RoleSlug::Admin->value);

    $this->postJson('/api/v1/login', [
        'email' => $user->email,
        'password' => 'password-123',
        'remember' => false,
    ])
        ->assertOk()
        ->assertJsonPath('data.dashboard_path', PostLoginRedirectResolver::ADMIN_HOME)
        ->assertJsonFragment([PermissionSlug::UsersManage->value]);
});

it('returns permissions and dashboard path on me endpoint', function () {
    $user = authExtensionUser(RoleSlug::Student->value);

    $this->actingAs($user, 'sanctum')
        ->getJson('/api/v1/me')
        ->assertOk()
        ->assertJsonPath('data.dashboard_path', PostLoginRedirectResolver::STUDENT_HOME)
        ->assertJsonFragment([PermissionSlug::AssignmentsSubmit->value]);
});
