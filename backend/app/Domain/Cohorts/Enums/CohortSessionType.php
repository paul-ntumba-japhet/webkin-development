<?php

namespace App\Domain\Cohorts\Enums;

enum CohortSessionType: string
{
    case COURSE = 'course';
    case WORKSHOP = 'workshop';
    case LAB = 'lab';
    case EXAM = 'exam';
    case MENTORING = 'mentoring';
}
