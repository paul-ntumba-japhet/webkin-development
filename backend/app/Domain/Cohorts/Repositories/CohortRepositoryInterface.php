<?php

namespace App\Domain\Cohorts\Repositories;

use App\Models\Cohort;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CohortRepositoryInterface
{
    public function findById(int $id): ?Cohort;
    public function findActiveByProgramId(int $programId): ?Cohort;
    public function paginateForProgram(int $programId, int $perPage = 15): LengthAwarePaginator;
    public function create(array $attributes): Cohort;
    public function update(Cohort $cohort, array $attributes): Cohort;
    public function delete(Cohort $cohort): bool;
}
