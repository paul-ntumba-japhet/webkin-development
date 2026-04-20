<?php

namespace App\Domain\Billing\Services;

use App\Models\Enrollment;
use App\Models\EnrollmentBillingPeriod;

interface BillingPeriodSchedulerInterface
{
    public function openNextPeriod(Enrollment $enrollment): EnrollmentBillingPeriod;
}

