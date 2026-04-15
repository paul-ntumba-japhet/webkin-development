<?php

namespace App\Domain\Projects\Repositories;

use App\Models\StudentProject;
use Illuminate\Support\Collection;

interface StudentProjectRepositoryInterface
{
    public function findById(int $id): ?StudentProject;
    public function listByEnrollmentId(int $enrollmentId): Collection;
    public function create(array $attributes): StudentProject;
    public function update(StudentProject $project, array $attributes): StudentProject;
    public function delete(StudentProject $project): bool;
}

