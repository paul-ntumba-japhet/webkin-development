<?php

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Permission;
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

function adminActor(string ...$roleSlugs): User
{
    $user = User::query()->create([
        'first_name' => 'Admin',
        'last_name' => 'Actor',
        'email' => 'admin-actor-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1770'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleIds = Role::query()->whereIn('slug', $roleSlugs)->pluck('id');
    $user->roles()->sync($roleIds);

    return $user;
}

function targetUser(): User
{
    return User::query()->create([
        'first_name' => 'Target',
        'last_name' => 'User',
        'email' => 'target-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1771'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);
}

it('allows admin to list users with pagination', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    targetUser();
    targetUser();

    $this->getJson('/api/v1/admin/users?per_page=10')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'email', 'first_name', 'last_name', 'status', 'roles'],
            ],
            'links',
            'meta',
        ])
        ->assertJsonPath('meta.per_page', 10);
});

it('allows admin to get a single user', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    $user->roles()->sync([Role::query()->where('slug', RoleSlug::Student->value)->value('id')]);

    $this->getJson("/api/v1/admin/users/{$user->id}")
        ->assertOk()
        ->assertJsonPath('data.id', $user->id)
        ->assertJsonPath('data.email', $user->email)
        ->assertJsonFragment(['slug' => RoleSlug::Student->value]);
});

it('allows admin to create a user with roles', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');

    $this->postJson('/api/v1/admin/users', [
        'first_name' => 'New',
        'last_name' => 'Staff',
        'email' => 'new-staff-'.Str::lower(Str::random(6)).'@example.com',
        'phone' => '+1999'.Str::random(10),
        'password' => 'password-123',
        'password_confirmation' => 'password-123',
        'role_ids' => [$studentRoleId],
    ])
        ->assertCreated()
        ->assertJsonPath('data.first_name', 'New')
        ->assertJsonFragment(['slug' => RoleSlug::Student->value]);
});

it('allows admin to update a user profile', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();

    $this->putJson("/api/v1/admin/users/{$user->id}", [
        'first_name' => 'Updated',
        'last_name' => 'Name',
        'city' => 'Kinshasa',
    ])
        ->assertOk()
        ->assertJsonPath('data.first_name', 'Updated')
        ->assertJsonPath('data.last_name', 'Name')
        ->assertJsonPath('data.city', 'Kinshasa');

    expect($user->fresh())
        ->first_name->toBe('Updated')
        ->last_name->toBe('Name')
        ->city->toBe('Kinshasa');
});

it('allows admin to update a user status', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    expect($user->status)->toBe(UserStatus::ACTIVE);

    $this->patchJson("/api/v1/admin/users/{$user->id}/status", [
        'status' => UserStatus::SUSPENDED->value,
    ])
        ->assertOk()
        ->assertJsonPath('data.status', UserStatus::SUSPENDED->value);

    expect($user->fresh()->status)->toBe(UserStatus::SUSPENDED);
});

it('revokes tokens when admin suspends a user via status endpoint', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    $token = $user->createToken('phpunit')->plainTextToken;

    $this->patchJson("/api/v1/admin/users/{$user->id}/status", [
        'status' => UserStatus::SUSPENDED->value,
    ])->assertOk();

    $this->app['auth']->forgetGuards();

    expect($user->fresh()->tokens)->toBeEmpty();

    $this->withToken($token)->getJson('/api/v1/me')->assertUnauthorized();
});

it('allows admin to assign roles to a user', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    $editorRoleId = Role::query()->where('slug', RoleSlug::Editor->value)->value('id');

    $this->putJson("/api/v1/admin/users/{$user->id}/roles", [
        'role_ids' => [$editorRoleId],
    ])
        ->assertOk()
        ->assertJsonFragment(['slug' => RoleSlug::Editor->value]);
});

it('allows admin to remove roles from a user', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');
    $editorRoleId = Role::query()->where('slug', RoleSlug::Editor->value)->value('id');
    $user->roles()->sync([$studentRoleId, $editorRoleId]);

    $this->deleteJson("/api/v1/admin/users/{$user->id}/roles", [
        'role_ids' => [$editorRoleId],
    ])
        ->assertOk()
        ->assertJsonFragment(['slug' => RoleSlug::Student->value])
        ->assertJsonMissing(['slug' => RoleSlug::Editor->value]);

    expect($user->fresh()->roles)->toHaveCount(1);
});

it('denies removing all roles from a user', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    $studentRoleId = Role::query()->where('slug', RoleSlug::Student->value)->value('id');
    $user->roles()->sync([$studentRoleId]);

    $this->deleteJson("/api/v1/admin/users/{$user->id}/roles", [
        'role_ids' => [$studentRoleId],
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['role_ids'])
        ->assertJsonPath('errors.role_ids.0', __('users.role_cannot_remove_all'));
});

it('allows admin to create a role', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $this->postJson('/api/v1/admin/roles', [
        'name' => 'Coach',
        'slug' => 'coach',
        'description' => 'Coaching staff role',
    ])
        ->assertCreated()
        ->assertJsonPath('data.name', 'Coach')
        ->assertJsonPath('data.slug', 'coach')
        ->assertJsonPath('data.description', 'Coaching staff role');

    expect(Role::query()->where('slug', 'coach')->exists())->toBeTrue();
});

it('allows admin to update a role', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $role = Role::query()->create([
        'name' => 'Coach',
        'slug' => 'coach',
        'description' => 'Old description',
    ]);

    $this->putJson("/api/v1/admin/roles/{$role->id}", [
        'name' => 'Senior Coach',
        'description' => 'Updated description',
    ])
        ->assertOk()
        ->assertJsonPath('data.name', 'Senior Coach')
        ->assertJsonPath('data.slug', 'coach')
        ->assertJsonPath('data.description', 'Updated description');

    expect($role->fresh())
        ->name->toBe('Senior Coach')
        ->description->toBe('Updated description');
});

it('allows admin to sync role permissions', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $role = Role::query()->where('slug', RoleSlug::Student->value)->firstOrFail();
    $permissionId = Permission::query()->where('slug', PermissionSlug::AssignmentsSubmit->value)->value('id');

    $this->putJson("/api/v1/admin/roles/{$role->id}/permissions", [
        'permission_ids' => [$permissionId],
    ])
        ->assertOk()
        ->assertJsonFragment(['slug' => PermissionSlug::AssignmentsSubmit->value]);

    expect($role->fresh()->permissions)->toHaveCount(1);
});

it('allows admin to grant and revoke a user permission override', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Admin->value));

    $user = targetUser();
    $user->roles()->sync([Role::query()->where('slug', RoleSlug::Student->value)->value('id')]);

    $managePermissionId = Permission::query()->where('slug', PermissionSlug::UsersManage->value)->value('id');

    $this->putJson("/api/v1/admin/users/{$user->id}/permissions", [
        'permission_id' => $managePermissionId,
        'granted' => true,
    ])->assertOk();

    expect($user->fresh()->hasPermission(PermissionSlug::UsersManage))->toBeTrue();

    $this->putJson("/api/v1/admin/users/{$user->id}/permissions", [
        'permission_id' => $managePermissionId,
        'granted' => false,
    ])->assertOk();

    expect($user->fresh()->hasPermission(PermissionSlug::UsersManage))->toBeFalse();
});

it('denies student from admin identity management endpoints', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Student->value));

    $user = targetUser();

    $this->putJson("/api/v1/admin/users/{$user->id}", [
        'first_name' => 'Hack',
    ])->assertForbidden();

    $this->patchJson("/api/v1/admin/users/{$user->id}/status", [
        'status' => UserStatus::SUSPENDED->value,
    ])->assertForbidden();

    $this->deleteJson("/api/v1/admin/users/{$user->id}/roles", [
        'role_ids' => [1],
    ])->assertForbidden();

    $this->getJson('/api/v1/admin/users')->assertForbidden();

    $target = targetUser();

    $this->getJson("/api/v1/admin/users/{$target->id}")->assertForbidden();

    $this->postJson('/api/v1/admin/roles', [
        'name' => 'Hack Role',
    ])->assertForbidden();

    $role = Role::query()->where('slug', RoleSlug::Student->value)->firstOrFail();

    $this->putJson("/api/v1/admin/roles/{$role->id}", [
        'name' => 'Hacked',
    ])->assertForbidden();

    $this->postJson('/api/v1/admin/users', [
        'first_name' => 'Hack',
        'last_name' => 'Er',
        'email' => 'hack-'.Str::lower(Str::random(6)).'@example.com',
        'password' => 'password-123',
        'password_confirmation' => 'password-123',
        'role_ids' => [1],
    ])->assertForbidden();
});

it('denies editor from admin identity management endpoints', function () {
    Sanctum::actingAs(adminActor(RoleSlug::Editor->value));

    $user = targetUser();

    $this->putJson("/api/v1/admin/users/{$user->id}/roles", [
        'role_ids' => [Role::query()->where('slug', RoleSlug::Student->value)->value('id')],
    ])->assertForbidden();
});
