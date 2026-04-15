<?php

namespace App\Domain\Assignments\Repositories;

use App\Models\Assignment;
use Illuminate\Support\Collection;

interface AssignmentRepositoryInterface
{
    public function findById(int $id): ?Assignment;
    public function listByLessonId(int $lessonId): Collection;
    public function create(array $attributes): Assignment;
    public function update(Assignment $assignment, array $attributes): Assignment;
    public function delete(Assignment $assignment): bool;
}

