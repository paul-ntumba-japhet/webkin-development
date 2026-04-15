<?php

namespace App\Infrastructure\Persistence\Repositories\Assignments;

use App\Domain\Assignments\Repositories\AssignmentRepositoryInterface;
use App\Models\Assignment;
use Illuminate\Support\Collection;


final class EloquentAssignmentRepository implements AssignmentRepositoryInterface
{
    public function findById(int $id): ?Assignment
    {
        return Assignment::query()->find($id);
    }
    public function listByLessonId(int $lessonId): Collection
    {
        return Assignment::query()->where('lesson_id', $lessonId)->orderBy('position')->get();
    }
    public function create(array $attributes): Assignment
    {
        return Assignment::query()->create($attributes);
    }
    public function update(Assignment $assignment, array $attributes): Assignment
    {
        $assignment->update($attributes);

        return $assignment->refresh();
    }
    public function delete(Assignment $assignment): bool
    {
        return $assignment->delete();
    }
}
