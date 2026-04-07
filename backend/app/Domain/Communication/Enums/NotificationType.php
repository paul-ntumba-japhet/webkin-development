<?php

namespace App\Domain\Communication\Enums;



enum NotificationType: string
{
    case SYSTEM = 'system';
    case BILLING = 'billing';
    case ACADEMIC = 'academic';
    case MARKETING = 'marketing';
    case SUPPORT = 'support';
}
