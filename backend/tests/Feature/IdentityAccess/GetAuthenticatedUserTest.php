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

it('returns fresh authenticated user with roles via me endpoint', function () {
    $user = User::query()->create([
        'first_name' => 'Me',
        'last_name' => 'User',
        'email' => 'me-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1333'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');
    $user->roles()->sync([$studentRoleId]);

    Sanctum::actingAs($user);

    $editorRoleId = Role::query()->where('slug', RoleSlug::Editor->value)->value('id');
    $user->roles()->sync([$editorRoleId]);

    $this->getJson('/api/v1/me')
        ->assertOk()
        ->assertJsonPath('data.email', $user->email)
        ->assertJsonFragment(['slug' => RoleSlug::Editor->value])
        ->assertJsonMissing(['slug' => RoleSlug::Student->value]);
});
