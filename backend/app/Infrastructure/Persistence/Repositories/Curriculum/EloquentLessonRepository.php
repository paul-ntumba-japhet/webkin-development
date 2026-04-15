<?php

namespace App\Infrastructure\Persistence\Repositories\Curriculum;

use App\Domain\Curriculum\Repositories\LessonRepositoryInterface;
use App\Models\Lesson;
use Illuminate\Support\Collection;


final class EloquentLessonRepository implements LessonRepositoryInterface
{
    public function findById(int $id): ?Lesson
    {
        return Lesson::query()->find($id);
    }
    public function listByProgramModuleId(int $programModuleId): Collection
    {
        return Lesson::query()->where('program_module_id', $programModuleId)->orderBy('position')->get();
    }
    public function create(array $attributes): Lesson
    {
        return Lesson::query()->create($attributes);
    }
    public function update(Lesson $lesson, array $attributes): Lesson
    {
        $lesson->update($attributes);

        return $lesson->refresh();
    }
    public function delete(Lesson $lesson): bool
    {
        return $lesson->delete();
    }
}
