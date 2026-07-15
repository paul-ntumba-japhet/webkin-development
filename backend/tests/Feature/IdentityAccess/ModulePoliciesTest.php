<?php

use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\Programs\Enums\ProgramStatus;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Assignment;
use App\Models\Cohort;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PermissionSeeder::class);
    $this->seed(RoleSeeder::class);
});

function policyTestUser(string ...$roleSlugs): User
{
    $user = User::query()->create([
        'first_name' => 'Policy',
        'last_name' => 'Test',
        'email' => 'policy-'.Str::lower(Str::random(8)).'@example.com',
        'phone' => '+1889'.Str::random(10),
        'password' => 'password-123',
        'status' => UserStatus::ACTIVE,
    ]);

    $roleIds = Role::query()->whereIn('slug', $roleSlugs)->pluck('id');
    $user->roles()->sync($roleIds);

    return $user;
}

function testProgram(): Program
{
    return new Program([
        'title' => 'Test Program',
        'slug' => 'test-program-'.Str::lower(Str::random(6)),
        'short_description' => 'Short',
        'duration_value' => 6,
        'status' => ProgramStatus::DRAFT,
    ]);
}

it('allows admin to manage users via user policy', function () {
    $admin = policyTestUser(RoleSlug::Admin->value);

    expect(Gate::forUser($admin)->allows('viewAny', User::class))->toBeTrue()
        ->and(Gate::forUser($admin)->allows('create', User::class))->toBeTrue();
});

it('denies student from viewing users via user policy', function () {
    $student = policyTestUser(RoleSlug::Student->value);

    expect(Gate::forUser($student)->allows('viewAny', User::class))->toBeFalse();
});

it('allows editor to publish programs', function () {
    $editor = policyTestUser(RoleSlug::Editor->value);
    $program = testProgram();

    expect(Gate::forUser($editor)->allows('publish', $program))->toBeTrue();
});

it('denies student from publishing programs', function () {
    $student = policyTestUser(RoleSlug::Student->value);
    $program = testProgram();

    expect(Gate::forUser($student)->allows('publish', $program))->toBeFalse();
});

it('allows admin to approve enrollments', function () {
    $admin = policyTestUser(RoleSlug::Admin->value);
    $enrollment = new Enrollment;

    expect(Gate::forUser($admin)->allows('approve', $enrollment))->toBeTrue();
});

it('allows student to submit assignments', function () {
    $student = policyTestUser(RoleSlug::Student->value);
    $assignment = new Assignment;

    expect(Gate::forUser($student)->allows('submit', $assignment))->toBeTrue()
        ->and(Gate::forUser($student)->allows('review', $assignment))->toBeFalse();
});

it('allows editor to review assignments', function () {
    $editor = policyTestUser(RoleSlug::Editor->value);
    $assignment = new Assignment;

    expect(Gate::forUser($editor)->allows('review', $assignment))->toBeTrue();
});

it('allows editor to manage cohort schedules', function () {
    $editor = policyTestUser(RoleSlug::Editor->value);
    $cohort = new Cohort;

    expect(Gate::forUser($editor)->allows('manageSchedules', $cohort))->toBeTrue();
});

it('grants super admin all policy abilities', function () {
    $superAdmin = policyTestUser(RoleSlug::SuperAdmin->value);
    $setting = new Setting;

    expect(Gate::forUser($superAdmin)->allows('update', $setting))->toBeTrue()
        ->and(Gate::forUser($superAdmin)->allows('publish', testProgram()))->toBeTrue();
});
