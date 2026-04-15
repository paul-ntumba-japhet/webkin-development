<?php

namespace App\Infrastructure\Persistence\Repositories\Curriculum;

use App\Domain\Curriculum\Repositories\StudentProgressRepositoryInterface;
use App\Models\StudentProgress;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentStudentProgressRepository implements StudentProgressRepositoryInterface
{
    public function findById(int $id): ?StudentProgress
    {
        return StudentProgress::query()->find($id);
    }
    public function findForEnrollmentAndLesson(int $enrollmentId, int $lessonId): ?StudentProgress
    {
        return StudentProgress::query()->where('enrollment_id', $enrollmentId)->where('lesson_id', $lessonId)->first();
    }
    public function createOrUpdate(array $attributes): StudentProgress
    {
        return StudentProgress::query()->updateOrCreate(
            [
                'enrollment_id' => $attributes['enrollment_id'],
                'lesson_id' => $attributes['lesson_id'],
            ],
            $attributes
        );
    }
    public function listByEnrollmentId(int $enrollmentId): Collection
    {
        return StudentProgress::query()->where('enrollment_id', $enrollmentId)->latest('id')->get();
    }
}


