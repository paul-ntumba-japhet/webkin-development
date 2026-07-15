<?php

namespace App\Policies;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\Assignment;
use App\Models\User;
use App\Policies\Concerns\AuthorizesWithPermission;

final class AssignmentPolicy
{
    use AuthorizesWithPermission;

    public function review(User $user, Assignment $assignment): bool
    {
        return $this->allowsPermission($user, PermissionSlug::AssignmentsReview);
    }

    public function submit(User $user, Assignment $assignment): bool
    {
        return $this->allowsPermission($user, PermissionSlug::AssignmentsSubmit);
    }
}
