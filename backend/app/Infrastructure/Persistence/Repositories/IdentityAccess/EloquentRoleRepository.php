<?php

namespace App\Infrastructure\Persistence\Repositories\IdentityAccess;

use App\Models\Role;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;

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
    public function all(): Collection
    {
        return Role::query()->orderBy('name')->get();
    }
    public function create(array $attributes): Role
    {
        return Role::query()->create($attributes);
    }
    public function syncUserRoles(User $user, array $roleIds): void
    {
        $user->roles()->sync($roleIds);
    }
}
