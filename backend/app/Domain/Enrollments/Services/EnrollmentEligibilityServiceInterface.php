<?php

namespace App\Domain\Enrollments\Services;



interface EnrollmentEligibilityServiceInterface
{
    public function assertCanEnroll(int $studentId, int $programId, ?int $cohortId = null): void;
}

