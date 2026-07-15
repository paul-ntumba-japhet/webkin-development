<?php

use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\IdentityAccess\Services\PostLoginRedirectResolver;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->resolver = app(PostLoginRedirectResolver::class);
});

function redirectTestUser(array $roleSlugs): User
{
    $user = User::query()->create([
        'first_name' => 'Redirect',
        'last_name' => 'Test',
        'email' => 'redir-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1222'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleIds = Role::query()->whereIn('slug', $roleSlugs)->pluck('id');
    $user->roles()->sync($roleIds);

    return $user->load('roles');
}

it('redirects students to user home', function () {
    $user = redirectTestUser([RoleSlug::Student->value]);

    expect($this->resolver->pathFor($user))->toBe(PostLoginRedirectResolver::STUDENT_HOME);
});

it('redirects admin area users to admin home', function () {
    $admin = redirectTestUser([RoleSlug::Admin->value]);
    $superAdmin = redirectTestUser([RoleSlug::SuperAdmin->value]);

    expect($this->resolver->pathFor($admin))->toBe(PostLoginRedirectResolver::ADMIN_HOME)
        ->and($this->resolver->pathFor($superAdmin))->toBe(PostLoginRedirectResolver::ADMIN_HOME);
});

it('redirects editors to admin home', function () {
    $editor = redirectTestUser([RoleSlug::Editor->value]);

    expect($this->resolver->pathFor($editor))->toBe(PostLoginRedirectResolver::ADMIN_HOME);
});

it('prioritizes admin home when user has student and admin roles', function () {
    $user = redirectTestUser([RoleSlug::Student->value, RoleSlug::Admin->value]);

    expect($this->resolver->pathFor($user))->toBe(PostLoginRedirectResolver::ADMIN_HOME);
});

it('throws when user has no dashboard role', function () {
    $user = User::query()->create([
        'first_name' => 'No',
        'last_name' => 'Role',
        'email' => 'norole-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1333'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $this->resolver->pathFor($user);
})->throws(HttpException::class);
