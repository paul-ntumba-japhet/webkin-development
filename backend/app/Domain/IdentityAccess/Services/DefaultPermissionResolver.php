<?php

namespace App\Domain\IdentityAccess\Services;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Models\Permission;
use App\Models\User;

final class DefaultPermissionResolver implements PermissionResolverInterface
{
    /** @var array<int, list<string>> */
    private array $slugsByUserId = [];

    /** @var array<int, bool> */
    private array $superAdminByUserId = [];

    public function hasPermission(User $user, PermissionSlug|string $permission): bool
    {
        if ($this->userIsSuperAdmin($user)) {
            return true;
        }

        $slug = $permission instanceof PermissionSlug ? $permission->value : $permission;

        return in_array($slug, $this->permissionSlugsFor($user), true);
    }

    public function permissionSlugsFor(User $user): array
    {
        $userId = (int) $user->getKey();

        if (isset($this->slugsByUserId[$userId])) {
            return $this->slugsByUserId[$userId];
        }

        if ($this->userIsSuperAdmin($user)) {
            return $this->slugsByUserId[$userId] = $this->allPermissionSlugs();
        }

        $slugs = $this->rolePermissionSlugsFor($user);
        $slugs = $this->applyUserPermissionOverrides($user, $slugs);

        sort($slugs);

        return $this->slugsByUserId[$userId] = array_values(array_unique($slugs));
    }

    private function userIsSuperAdmin(User $user): bool
    {
        $userId = (int) $user->getKey();

        if (isset($this->superAdminByUserId[$userId])) {
            return $this->superAdminByUserId[$userId];
        }

        if ($user->relationLoaded('roles')) {
            return $this->superAdminByUserId[$userId] = $user->roles
                ->contains(static fn ($role): bool => $role->slug === RoleSlug::SuperAdmin->value);
        }

        return $this->superAdminByUserId[$userId] = $user->roles()
            ->where('slug', RoleSlug::SuperAdmin->value)
            ->exists();
    }

    /** @return list<string> */
    private function allPermissionSlugs(): array
    {
        return Permission::query()
            ->orderBy('slug')
            ->pluck('slug')
            ->all();
    }

    /** @return list<string> */
    private function rolePermissionSlugsFor(User $user): array
    {
        return Permission::query()
            ->whereHas('roles', function ($query) use ($user): void {
                $query->whereHas('users', function ($query) use ($user): void {
                    $query->where('users.id', $user->getKey());
                });
            })
            ->pluck('slug')
            ->all();
    }

    /**
     * @param  list<string>  $slugs
     * @return list<string>
     */
    private function applyUserPermissionOverrides(User $user, array $slugs): array
    {
        $indexed = array_fill_keys($slugs, true);

        $overrides = $user->permissions()->get(['permissions.id', 'permissions.slug']);

        foreach ($overrides as $permission) {
            if ((bool) $permission->pivot->granted) {
                $indexed[$permission->slug] = true;
            } else {
                unset($indexed[$permission->slug]);
            }
        }

        return array_keys($indexed);
    }
}
