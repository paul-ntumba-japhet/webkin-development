<?php

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

it('authenticates via post api v1 login and returns user resource json', function () {
    $email = 'sanctum-login-'.Str::lower(Str::random(10)).'@example.com';

    $user = User::query()->create([
        'first_name' => 'Sanctum',
        'last_name' => 'Login',
        'email' => $email,
        'phone' => '+1555'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');
    $user->roles()->sync([$studentRoleId]);

    $response = $this->postJson('/api/v1/login', [
        'email' => $email,
        'password' => 'password-123',
        'remember' => false,
    ]);

    $response->assertOk()
        ->assertJsonPath('data.email', $email)
        ->assertJsonPath('data.first_name', 'Sanctum')
        ->assertJsonPath('data.last_name', 'Login')
        ->assertJsonPath('data.dashboard_path', PostLoginRedirectResolver::STUDENT_HOME);

    $this->assertAuthenticated('web');
});

it('denies login when account is suspended', function () {
    $email = 'sanctum-suspended-'.Str::lower(Str::random(10)).'@example.com';

    User::query()->create([
        'first_name' => 'Suspended',
        'last_name' => 'User',
        'email' => $email,
        'phone' => '+1556'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::SUSPENDED,
    ]);

    $this->postJson('/api/v1/login', [
        'email' => $email,
        'password' => 'password-123',
        'remember' => false,
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email'])
        ->assertJsonPath('errors.email.0', __('auth.account_suspended'));

    $this->assertGuest('web');
});

it('returns validation error when credentials are invalid', function () {
    $email = 'sanctum-bad-'.Str::lower(Str::random(10)).'@example.com';

    User::query()->create([
        'first_name' => 'Bad',
        'last_name' => 'Creds',
        'email' => $email,
        'phone' => '+1666'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $this->postJson('/api/v1/login', [
        'email' => $email,
        'password' => 'not-the-password',
        'remember' => false,
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
});
