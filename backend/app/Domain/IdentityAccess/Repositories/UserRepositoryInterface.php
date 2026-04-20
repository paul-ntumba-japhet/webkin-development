<?php

namespace App\Domain\IdentityAccess\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function paginateBackoffice(int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): User;
    public function update(User $user, array $attributes): User;
    public function delete(User $user): bool;

}
