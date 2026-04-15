<?php

namespace App\Infrastructure\Persistence\Repositories\Projects;

use App\Domain\Projects\Repositories\StudentProjectRepositoryInterface;
use App\Models\StudentProject;
use Illuminate\Support\Collection;


final class EloquentStudentProjectRepository implements StudentProjectRepositoryInterface
{
    public function findById(int $id): ?StudentProject
    {
        return StudentProject::query()->find($id);
    }
    public function listByEnrollmentId(int $enrollmentId): Collection
    {
        return StudentProject::query()->where('enrollment_id', $enrollmentId)->latest('id')->get();
    }
    public function create(array $attributes): StudentProject
    {
        return StudentProject::query()->create($attributes);
    }
    public function update(StudentProject $project, array $attributes): StudentProject
    {
        $project->update($attributes);

        return $project->refresh();
    }
    public function delete(StudentProject $project): bool
    {
        return $project->delete();
    }
}
