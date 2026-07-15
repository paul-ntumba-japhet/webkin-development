<?php

namespace Database\Seeders;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (RoleSlug::cases() as $roleSlug) {
            Role::query()->firstOrCreate(
                ['slug' => $roleSlug->value],
                [
                    'name' => $roleSlug->label(),
                    'description' => $roleSlug->description(),
                ],
            );
        }

        $this->syncRolePermissions();
    }

    private function syncRolePermissions(): void
    {
        $map = [
            RoleSlug::Student->value => [
                PermissionSlug::AssignmentsSubmit,
            ],
            RoleSlug::Editor->value => [
                PermissionSlug::ProgramsView,
                PermissionSlug::ProgramsPublish,
                PermissionSlug::AssignmentsReview,
                PermissionSlug::CohortsManageSchedules,
            ],
            RoleSlug::Admin->value => [
                PermissionSlug::UsersView,
                PermissionSlug::UsersManage,
                PermissionSlug::UsersCreate,
                PermissionSlug::UsersUpdate,
                PermissionSlug::ProgramsView,
                PermissionSlug::ProgramsPublish,
                PermissionSlug::EnrollmentsApprove,
                PermissionSlug::AssignmentsReview,
                PermissionSlug::CohortsManageSchedules,
            ],
            RoleSlug::SuperAdmin->value => PermissionSlug::cases(),
        ];

        foreach ($map as $roleSlug => $permissionSlugs) {
            $role = Role::query()->where('slug', $roleSlug)->first();

            if ($role === null) {
                continue;
            }

            $slugs = array_map(
                static fn (PermissionSlug $slug): string => $slug->value,
                $permissionSlugs,
            );

            $permissionIds = Permission::query()->whereIn('slug', $slugs)->pluck('id');

            $role->permissions()->sync($permissionIds);
        }
    }
}
