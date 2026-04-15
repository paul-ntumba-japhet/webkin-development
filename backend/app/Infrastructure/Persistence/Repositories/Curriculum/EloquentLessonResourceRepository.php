<?php

namespace App\Infrastructure\Persistence\Repositories\Curriculum;

use App\Domain\Curriculum\Repositories\LessonResourceRepositoryInterface;
use App\Models\LessonResource;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Lesson;

final class EloquentLessonResourceRepository implements LessonResourceRepositoryInterface
{
    public function listByLessonId(int $lessonId): Collection
    {
        return LessonResource::query()->where('lesson_id', $lessonId)->orderBy('position')->get();
    }
    public function createManyForLesson(Lesson $lesson, array $rows): Collection
    {
        return DB::transaction(function () use ($lesson, $rows) {
            $items = collect();

            foreach ($rows as $row) {
                $row['lesson_id'] = $lesson->id;
                $items->push(LessonResource::query()->create($row));
            }

            return $items;
        });
    }
    public function deleteByLessonId(int $lessonId): void
    {
        LessonResource::query()->where('lesson_id', $lessonId)->delete();
    }
}
