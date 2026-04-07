<?php

namespace App\Domain\Enrollments\Enums;

enum EnrollmentStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
