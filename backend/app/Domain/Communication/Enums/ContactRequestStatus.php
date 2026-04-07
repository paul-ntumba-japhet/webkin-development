<?php

namespace App\Domain\Communication\Enums;

enum ContactRequestStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
}


