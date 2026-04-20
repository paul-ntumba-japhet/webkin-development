<?php

namespace App\Domain\IdentityAccess\Services;

use App\Domain\IdentityAccess\Services\RoleAssignmentServiceInterface;
use App\Models\User;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use InvalidArgumentException;

final class DefaultRoleAssignmentService implements RoleAssignmentServiceInterface
{
    public function __construct(
        private readonly RoleRepositoryInterface $roles,
    ) {
    }

    public function assign(User $user, array $roleIds): void
    {
        if ($roleIds === []) {
            throw new InvalidArgumentException('Au moins un rôle doit être fourni.');
        }

        $this->roles->syncUserRoles($user, $roleIds);
    }
}
