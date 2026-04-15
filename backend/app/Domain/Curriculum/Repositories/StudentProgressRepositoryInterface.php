<?php


namespace App\Domain\Curriculum\Repositories;

use App\Models\StudentProgress;
use Illuminate\Support\Collection;

interface StudentProgressRepositoryInterface
{
    public function findById(int $id): ?StudentProgress;
    public function findForEnrollmentAndLesson(int $enrollmentId, int $lessonId): ?StudentProgress;
    public function createOrUpdate(array $attributes): StudentProgress;
    public function listByEnrollmentId(int $enrollmentId): Collection;
}


