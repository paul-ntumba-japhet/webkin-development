<?php

namespace App\Domain\Communication\Enums;

enum QuestionStatus: string
{
    case OPEN = 'open';
    case ANSWERED = 'answered';
    case CLOSED = 'closed';
}
