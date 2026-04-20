<?php

namespace App\Domain\Communication\Services;

use App\Domain\Communication\Services\StudentQuestionWorkflowServiceInterface;
use App\Models\StudentQuestion;
use App\Domain\Communication\Repositories\StudentQuestionRepositoryInterface;

final class DefaultStudentQuestionWorkflowService implements StudentQuestionWorkflowServiceInterface
{
    public function __construct(
        private readonly StudentQuestionRepositoryInterface $questions,
    ) {
    }

    public function resolve(StudentQuestion $question): StudentQuestion
    {
        return $this->questions->updateStatus($question, 'resolved');
    }
}
