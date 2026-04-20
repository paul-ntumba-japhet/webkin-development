<?php

namespace App\Domain\Billing\Services;

use App\Domain\Billing\Services\BillingPeriodSchedulerInterface;
use App\Models\Enrollment;
use App\Models\EnrollmentBillingPeriod;
use App\Domain\Billing\Repositories\EnrollmentBillingPeriodRepositoryInterface;

final class DefaultBillingPeriodScheduler implements BillingPeriodSchedulerInterface
{
    public function __construct(
        private readonly EnrollmentBillingPeriodRepositoryInterface $billingPeriods,
    ) {
    }

    public function openNextPeriod(Enrollment $enrollment): EnrollmentBillingPeriod
    {
        return $this->billingPeriods->create([
            'enrollment_id' => $enrollment->id,
            'status' => 'open',
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
        ]);
    }
}
