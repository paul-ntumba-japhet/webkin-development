<?php

namespace App\Domain\Assignments\Services;

use App\Models\AssignmentSubmission;

interface AssignmentReviewWorkflowServiceInterface
{
    public function markReviewed(AssignmentSubmission $submission, ?int $score = null): AssignmentSubmission;
}


