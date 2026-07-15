<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\ListUsersData;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

final class ListUsersAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function execute(User $actor, ListUsersData $data): LengthAwarePaginator
    {
        Gate::forUser($actor)->authorize('viewAny', User::class);

        return $this->users->paginateBackoffice($data->perPage);
    }
}
