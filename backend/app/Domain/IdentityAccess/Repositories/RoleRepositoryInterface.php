<?php

namespace App\Domain\IdentityAccess\Repositories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function findById(int $id): ?Role;
    public function findByName(string $name): ?Role;
    public function all(): Collection;
    public function create(array $attributes): Role;
    public function syncUserRoles(User $user, array $roleIds): void;
}

