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

it('issues a bearer token without session via post access-token', function () {
    $email = 'pat-'.Str::lower(Str::random(8)).'@example.com';

    $user = User::query()->create([
        'first_name' => 'Pat',
        'last_name' => 'User',
        'email' => $email,
        'phone' => '+1777'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');
    $user->roles()->sync([$studentRoleId]);

    $issue = $this->postJson('/api/v1/access-token', [
        'email' => $email,
        'password' => 'password-123',
        'device_name' => 'phpunit',
    ]);

    $issue->assertOk()
        ->assertJsonPath('token_type', 'Bearer')
        ->assertJsonStructure(['token', 'token_type', 'user'])
        ->assertJsonPath('user.email', $email);

    $token = $issue->json('token');
    expect($token)->toBeString()->not->toBeEmpty();

    $this->withToken($token)->getJson('/api/v1/me')
        ->assertOk()
        ->assertJsonPath('data.email', $email)
        ->assertJsonPath('data.dashboard_path', PostLoginRedirectResolver::STUDENT_HOME)
        ->assertJsonFragment([PermissionSlug::AssignmentsSubmit->value]);
});

it('denies access-token when account is suspended', function () {
    $email = 'pat-suspended-'.Str::lower(Str::random(8)).'@example.com';

    User::query()->create([
        'first_name' => 'Pat',
        'last_name' => 'Suspended',
        'email' => $email,
        'phone' => '+1888'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::SUSPENDED,
    ]);

    $this->postJson('/api/v1/access-token', [
        'email' => $email,
        'password' => 'password-123',
        'device_name' => 'phpunit',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email'])
        ->assertJsonPath('errors.email.0', __('auth.account_suspended'));
});

it('revokes existing bearer token when account is suspended', function () {
    $email = 'pat-revoke-'.Str::lower(Str::random(8)).'@example.com';

    $user = User::query()->create([
        'first_name' => 'Pat',
        'last_name' => 'Revoke',
        'email' => $email,
        'phone' => '+1999'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');
    $user->roles()->sync([$studentRoleId]);

    $token = $user->createToken('phpunit')->plainTextToken;

    $user->update(['status' => UserStatus::SUSPENDED]);

    $this->withToken($token)->getJson('/api/v1/me')
        ->assertForbidden()
        ->assertJsonPath('message', __('auth.account_suspended'));

    expect($user->tokens()->count())->toBe(0);
});
