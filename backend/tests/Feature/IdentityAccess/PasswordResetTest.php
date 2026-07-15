<?php

use App\Domain\Users\Enums\UserStatus;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
});

function passwordResetUser(): User
{
    return User::query()->create([
        'first_name' => 'Reset',
        'last_name' => 'User',
        'email' => 'reset-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1555'.Str::random(10),
        'password' => 'old-password-123',
        'status' => UserStatus::ACTIVE,
    ]);
}

it('sends a reset notification for a known email', function () {
    Notification::fake();

    $user = passwordResetUser();

    $this->postJson('/api/v1/password/forgot', ['email' => $user->email])
        ->assertOk()
        ->assertJsonStructure(['message']);

    Notification::assertSentTo($user, ResetPassword::class);
});

it('returns success for an unknown email without revealing absence', function () {
    Notification::fake();

    $this->postJson('/api/v1/password/forgot', ['email' => 'unknown-'.Str::random(8).'@example.com'])
        ->assertOk();

    Notification::assertNothingSent();
});

it('resets the password with a valid token', function () {
    $user = passwordResetUser();
    $token = Password::broker('users')->createToken($user);

    $this->postJson('/api/v1/password/reset', [
        'email' => $user->email,
        'token' => $token,
        'password' => 'new-password-456',
        'password_confirmation' => 'new-password-456',
    ])
        ->assertOk()
        ->assertJsonStructure(['message']);

    $user->refresh();

    expect(Hash::check('new-password-456', $user->password))->toBeTrue()
        ->and(Hash::check('old-password-123', $user->password))->toBeFalse();
});

it('rejects reset with an invalid token', function () {
    $user = passwordResetUser();

    $this->postJson('/api/v1/password/reset', [
        'email' => $user->email,
        'token' => 'invalid-token',
        'password' => 'new-password-456',
        'password_confirmation' => 'new-password-456',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
});
