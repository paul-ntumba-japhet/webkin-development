<?php

namespace App\Domain\Assignments\Services;

use App\Domain\Assignments\Services\AssignmentSubmissionPolicyServiceInterface;
use App\Models\Assignment;
use DomainException;

final class DefaultAssignmentSubmissionPolicyService implements AssignmentSubmissionPolicyServiceInterface
{
    public function assertSubmittable(Assignment $assignment, int $studentId): void
    {
        if (! empty($assignment->due_at) && now()->greaterThan($assignment->due_at)) {
            throw new DomainException('La date limite de soumission est dépassée.');
        }
    }
}

