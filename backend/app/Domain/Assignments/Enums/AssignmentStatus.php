<?php

namespace App\Domain\Assignments\Enums;

enum SubmissionStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case REVIEWED = 'reviewed';
    case RETURNED = 'returned';
}
