<?php

namespace App\Domain\SupportMessaging\Enums;

enum SupportPriority: string
{
    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';
    case URGENT = 'urgent';
}
