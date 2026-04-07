<?php

namespace App\Domain\Challenges\Enums;

enum ChallengeStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}

