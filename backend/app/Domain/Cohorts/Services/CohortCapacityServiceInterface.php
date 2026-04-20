<?php

namespace App\Domain\Cohorts\Services;

use App\Models\Cohort;

interface CohortCapacityServiceInterface
{
    public function hasAvailableSeat(Cohort $cohort): bool;
}
