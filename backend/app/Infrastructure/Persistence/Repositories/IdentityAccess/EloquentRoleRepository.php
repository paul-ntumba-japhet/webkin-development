<?php

namespace App\Infrastructure\Persistence\Repositories\IdentityAccess;

use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;

final class EloquentRoleRepository implements RoleRepositoryInterface
{
    public function findById(int $id): ?Role
    {
        return Role::query()->find($id);
    }

    public function findByName(string $name): ?Role
    {
        return Role::query()->where('name', $name)->first();
    }

    public function findBySlug(string $slug): ?Role
    {
        return Role::query()->where('slug', $slug)->first();
    }

    public function all(): Collection
    {
        return Role::query()->orderBy('name')->get();
    }

    public function create(array $attributes): Role
    {
        return Role::query()->create($attributes);
    }

    public function update(Role $role, array $attributes): Role
    {
        $role->update($attributes);

        return $role->refresh();
    }

    public function syncUserRoles(User $user, array $roleIds): void
    {
        $user->roles()->sync($roleIds);
    }

    public function detachUserRoles(User $user, array $roleIds): void
    {
        if ($roleIds === []) {
            return;
        }

        $user->roles()->detach($roleIds);
    }
}
