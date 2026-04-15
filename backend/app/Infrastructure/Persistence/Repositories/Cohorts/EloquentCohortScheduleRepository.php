<?php

namespace App\Infrastructure\Persistence\Repositories\Cohorts;

use App\Domain\Cohorts\Repositories\CohortScheduleRepositoryInterface;
use App\Models\CohortSchedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Cohort;

final class EloquentCohortScheduleRepository implements CohortScheduleRepositoryInterface
{
    public function listByCohortId(int $cohortId): Collection
    {
        return CohortSchedule::query()->where('cohort_id', $cohortId)->orderBy('day_of_week')->get();
    }
    public function replaceForCohort(Cohort $cohort, array $rows): Collection
    {
        return DB::transaction(function () use ($cohort, $rows) {
            CohortSchedule::query()->where('cohort_id', $cohort->id)->delete();

            $items = collect();

            foreach ($rows as $row) {
                $row['cohort_id'] = $cohort->id;
                $items->push(CohortSchedule::query()->create($row));
            }

            return $items;
        });
    }
    public function create(array $attributes): CohortSchedule
    {
        return CohortSchedule::query()->create($attributes);
    }
    public function deleteByCohortId(int $cohortId): void
    {
        CohortSchedule::query()->where('cohort_id', $cohortId)->delete();
    }
}
