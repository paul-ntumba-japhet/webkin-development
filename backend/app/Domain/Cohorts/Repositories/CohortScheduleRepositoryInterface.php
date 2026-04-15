<?php

namespace App\Domain\Cohorts\Repositories;

use App\Models\CohortSchedule;
use Illuminate\Support\Collection;
use App\Models\Cohort;

interface CohortScheduleRepositoryInterface
{
    public function listByCohortId(int $cohortId): Collection;
    public function replaceForCohort(Cohort $cohort, array $rows): Collection;
    public function create(array $attributes): CohortSchedule;
    public function deleteByCohortId(int $cohortId): void;
}


