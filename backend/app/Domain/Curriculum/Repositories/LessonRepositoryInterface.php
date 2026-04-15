<?php


namespace App\Domain\Curriculum\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Collection;

interface LessonRepositoryInterface
{
    public function findById(int $id): ?Lesson;
    public function listByProgramModuleId(int $programModuleId): Collection;
    public function create(array $attributes): Lesson;
    public function update(Lesson $lesson, array $attributes): Lesson;
    public function delete(Lesson $lesson): bool;
}
