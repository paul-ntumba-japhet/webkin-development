<?php

namespace App\Policies;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\Cohort;
use App\Models\User;
use App\Policies\Concerns\AuthorizesWithPermission;

final class CohortPolicy
{
    use AuthorizesWithPermission;

    public function manageSchedules(User $user, Cohort $cohort): bool
    {
        return $this->allowsPermission($user, PermissionSlug::CohortsManageSchedules);
    }
}
