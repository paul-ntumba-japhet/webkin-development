<?php

namespace App\Domain\Curriculum\Services;

use App\Models\Lesson;

interface CurriculumReleasePolicyServiceInterface
{
    public function canAccessLesson(int $enrollmentId, Lesson $lesson): bool;
}

