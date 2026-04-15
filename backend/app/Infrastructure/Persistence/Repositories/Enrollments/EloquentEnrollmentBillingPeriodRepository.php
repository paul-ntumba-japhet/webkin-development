<?php

namespace App\Infrastructure\Persistence\Repositories\Billing;

use App\Domain\Billing\Repositories\EnrollmentBillingPeriodRepositoryInterface;
use App\Models\EnrollmentBillingPeriod;
use Illuminate\Support\Collection;


final class EloquentEnrollmentBillingPeriodRepository implements EnrollmentBillingPeriodRepositoryInterface
{
    public function findCurrentOpenByEnrollmentId(int $enrollmentId): ?EnrollmentBillingPeriod
    {
        return EnrollmentBillingPeriod::query()->where('enrollment_id', $enrollmentId)->where('status', 'open')->latest('id')->first();
    }
    public function listByEnrollmentId(int $enrollmentId): Collection
    {
        return EnrollmentBillingPeriod::query()->where('enrollment_id', $enrollmentId)->latest('id')->get();
    }
    public function create(array $attributes): EnrollmentBillingPeriod
    {
        return EnrollmentBillingPeriod::query()->create($attributes);
    }
    public function closePeriod(EnrollmentBillingPeriod $period): EnrollmentBillingPeriod
    {
        $period->update(['status' => 'closed']);

        return $period->refresh();
    }
}
