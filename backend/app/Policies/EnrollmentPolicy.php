<?php

namespace App\Policies;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\Enrollment;
use App\Models\User;
use App\Policies\Concerns\AuthorizesWithPermission;

final class EnrollmentPolicy
{
    use AuthorizesWithPermission;

    public function approve(User $user, Enrollment $enrollment): bool
    {
        return $this->allowsPermission($user, PermissionSlug::EnrollmentsApprove);
    }
}
