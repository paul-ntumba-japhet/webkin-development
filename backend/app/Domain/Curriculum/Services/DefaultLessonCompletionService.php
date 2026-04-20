<?php

namespace App\Domain\Curriculum\Services;

use App\Domain\Curriculum\Services\LessonCompletionServiceInterface;
use App\Models\StudentProgress;
use App\Domain\Curriculum\Repositories\StudentProgressRepositoryInterface;

final class DefaultLessonCompletionService implements LessonCompletionServiceInterface
{
    public function __construct(
        private readonly StudentProgressRepositoryInterface $progress,
    ) {
    }

    public function markCompleted(int $enrollmentId, int $lessonId): StudentProgress
    {
        return $this->progress->createOrUpdate([
            'enrollment_id' => $enrollmentId,
            'lesson_id' => $lessonId,
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }
}
