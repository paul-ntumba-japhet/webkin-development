<?php

namespace App\Domain\IdentityAccess\Services;

use App\Models\User;

interface RoleAssignmentServiceInterface
{
    public function assign(User $user, array $roleIds): void;
}

