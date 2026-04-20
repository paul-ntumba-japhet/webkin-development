<?php

namespace App\Domain\Projects\Services;

use App\Models\StudentProject;

interface ProjectProgressServiceInterface
{
    public function computeCompletion(StudentProject $project): int;
}
