<?php

namespace App\Infrastructure\Persistence\Repositories\Cohorts;

use App\Domain\Cohorts\Repositories\CohortRepositoryInterface;
use App\Models\Cohort;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentCohortRepository implements CohortRepositoryInterface
{
    public function findById(int $id): ?Cohort
    {
        return Cohort::query()->find($id);
    }
    public function findActiveByProgramId(int $programId): ?Cohort
    {
        return Cohort::query()->where('program_id', $programId)->where('status', 'active')->latest('id')->first();
    }
    public function paginateForProgram(int $programId, int $perPage = 15): LengthAwarePaginator
    {
        return Cohort::query()->where('program_id', $programId)->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): Cohort
    {
        return Cohort::query()->create($attributes);
    }
    public function update(Cohort $cohort, array $attributes): Cohort
    {
        $cohort->update($attributes);

        return $cohort->refresh();
    }
    public function delete(Cohort $cohort): bool
    {
        return $cohort->delete();
    }
}
