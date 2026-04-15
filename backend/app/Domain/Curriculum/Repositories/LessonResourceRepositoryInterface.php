<?php

namespace App\Domain\Curriculum\Repositories;

use App\Models\LessonResource;
use Illuminate\Support\Collection;
use App\Models\Lesson;

interface LessonResourceRepositoryInterface
{
    public function listByLessonId(int $lessonId): Collection;
    public function createManyForLesson(Lesson $lesson, array $rows): Collection;
    public function deleteByLessonId(int $lessonId): void;
}

