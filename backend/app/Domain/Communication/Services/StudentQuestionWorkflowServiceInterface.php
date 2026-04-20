<?php

namespace App\Domain\Communication\Services;

use App\Models\StudentQuestion;

interface StudentQuestionWorkflowServiceInterface
{
    public function resolve(StudentQuestion $question): StudentQuestion;
}


