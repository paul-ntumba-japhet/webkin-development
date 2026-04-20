<?php

namespace App\Domain\Enrollments\Services;

use App\Domain\Enrollments\Services\EnrollmentLifecycleServiceInterface;
use App\Models\Enrollment;
use App\Domain\Enrollments\Repositories\EnrollmentRepositoryInterface;

final class DefaultEnrollmentLifecycleService implements EnrollmentLifecycleServiceInterface
{
    public function __construct(
        private readonly EnrollmentRepositoryInterface $enrollments,
    ) {
    }

    public function approve(Enrollment $enrollment): Enrollment
    {
        return $this->enrollments->updateStatus($enrollment, 'approved');
    }

    public function cancel(Enrollment $enrollment): Enrollment
    {
        return $this->enrollments->updateStatus($enrollment, 'cancelled');
    }
}

