<?php

namespace App\Domain\Cohorts\Enums;

enum CohortSessionStatus: string
{
    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case POSTPONED = 'postponed';
    case CANCELLED = 'cancelled';
}
