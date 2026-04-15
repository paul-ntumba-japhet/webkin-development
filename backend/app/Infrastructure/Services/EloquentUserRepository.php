<?php

namespace App\Infrastructure\Services;

use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        return User::query()->find($id);
    }
    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }
    public function paginateBackoffice(int $perPage = 20): LengthAwarePaginator
    {
        return User::query()->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): User
    {
        return User::query()->create($attributes);
    }
    public function update(User $user, array $attributes): User
    {
        $user->update($attributes);

        return $user->refresh();
    }
    public function delete(User $user): bool
    {
        return $user->delete();
    }

}
