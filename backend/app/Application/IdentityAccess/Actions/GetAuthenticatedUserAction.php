<?php

namespace App\Application\IdentityAccess\Actions;

use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

final class GetAuthenticatedUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function execute(User $actor): User
    {
        $user = $this->users->findById($actor->id);

        if ($user === null) {
            throw new AuthenticationException;
        }

        return $user->load(['roles']);
    }
}
