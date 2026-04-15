<?php

namespace App\Domain\Billing\Repositories;

use App\Models\EnrollmentBillingPeriod;
use Illuminate\Support\Collection;

interface EnrollmentBillingPeriodRepositoryInterface
{
    public function findCurrentOpenByEnrollmentId(int $enrollmentId): ?EnrollmentBillingPeriod;
    public function listByEnrollmentId(int $enrollmentId): Collection;
    public function create(array $attributes): EnrollmentBillingPeriod;
    public function closePeriod(EnrollmentBillingPeriod $period): EnrollmentBillingPeriod;
}
