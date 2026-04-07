<?php

namespace App\Domain\Challenges\Enums;

enum ChallengeSubmissionStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case REVIEWED = 'reviewed';
    case REJECTED = 'rejected';
}
