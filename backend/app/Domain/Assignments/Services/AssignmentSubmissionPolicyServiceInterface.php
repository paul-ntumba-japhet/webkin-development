<?php

namespace App\Domain\Assignments\Services;

use App\Models\Assignment;

interface AssignmentSubmissionPolicyServiceInterface
{
    public function assertSubmittable(Assignment $assignment, int $studentId): void;
}
