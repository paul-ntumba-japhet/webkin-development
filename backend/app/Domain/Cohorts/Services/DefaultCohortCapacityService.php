<?php

namespace App\Domain\Cohorts\Services;

use App\Domain\Cohorts\Services\CohortCapacityServiceInterface;
use App\Models\Cohort;

final class DefaultCohortCapacityService implements CohortCapacityServiceInterface
{
    public function hasAvailableSeat(Cohort $cohort): bool
    {
        $capacity = (int) ($cohort->capacity ?? 0);
        $current = (int) ($cohort->current_enrollments_count ?? $cohort->enrollments()->count());

        return $capacity === 0 || $current < $capacity;
    }
}
