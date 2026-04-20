<?php

namespace App\Domain\Curriculum\Services;

use App\Models\StudentProgress;

interface LessonCompletionServiceInterface
{
    public function markCompleted(int $enrollmentId, int $lessonId): StudentProgress;
}


