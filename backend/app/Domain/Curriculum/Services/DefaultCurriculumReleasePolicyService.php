<?php

namespace App\Domain\Curriculum\Services;

use App\Domain\Curriculum\Services\CurriculumReleasePolicyServiceInterface;
use App\Models\Lesson;

final class DefaultCurriculumReleasePolicyService implements CurriculumReleasePolicyServiceInterface
{
    public function canAccessLesson(int $enrollmentId, Lesson $lesson): bool
    {
        return (bool) ($lesson->is_published ?? true);
    }
}

