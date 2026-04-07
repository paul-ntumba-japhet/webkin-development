<?php

namespace App\Domain\Communication\Enums;

enum SupportConversationStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case WAITING_STUDENT = 'waiting_student';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
}

