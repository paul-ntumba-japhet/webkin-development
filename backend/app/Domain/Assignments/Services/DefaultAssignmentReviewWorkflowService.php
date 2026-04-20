<?php


namespace App\Domain\Assignments\Services;

use App\Domain\Assignments\Services\AssignmentReviewWorkflowServiceInterface;
//use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Domain\Assignments\Repositories\AssignmentSubmissionRepositoryInterface;

final class DefaultAssignmentReviewWorkflowService implements AssignmentReviewWorkflowServiceInterface
{
    public function __construct(
        private readonly AssignmentSubmissionRepositoryInterface $submissions,
    ) {
    }

    public function markReviewed(AssignmentSubmission $submission, ?int $score = null): AssignmentSubmission
    {
        $status = $score === null ? 'reviewed' : 'graded';

        return $this->submissions->updateStatus($submission, $status);
    }
}
