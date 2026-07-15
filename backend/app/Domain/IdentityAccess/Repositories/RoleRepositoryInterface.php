<?php

namespace App\Domain\IdentityAccess\Repositories;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function findById(int $id): ?Role;

    public function findByName(string $name): ?Role;

    public function findBySlug(string $slug): ?Role;

    public function all(): Collection;

    public function create(array $attributes): Role;

    public function update(Role $role, array $attributes): Role;

    public function syncUserRoles(User $user, array $roleIds): void;

    public function detachUserRoles(User $user, array $roleIds): void;
}
