<?php

namespace App\Domain\Projects\Services;

use App\Domain\Projects\Services\ProjectProgressServiceInterface;
use App\Models\StudentProject;

final class DefaultProjectProgressService implements ProjectProgressServiceInterface
{
    public function computeCompletion(StudentProject $project): int
    {
        return (int) ($project->progress_percentage ?? 0);
    }
}
