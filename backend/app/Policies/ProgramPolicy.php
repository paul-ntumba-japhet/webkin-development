<?php

namespace App\Policies;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\Program;
use App\Models\User;
use App\Policies\Concerns\AuthorizesWithPermission;

final class ProgramPolicy
{
    use AuthorizesWithPermission;

    public function viewAny(User $user): bool
    {
        return $this->allowsPermission($user, PermissionSlug::ProgramsView);
    }

    public function view(User $user, Program $program): bool
    {
        return $this->allowsPermission($user, PermissionSlug::ProgramsView);
    }

    public function publish(User $user, Program $program): bool
    {
        return $this->allowsPermission($user, PermissionSlug::ProgramsPublish);
    }
}
