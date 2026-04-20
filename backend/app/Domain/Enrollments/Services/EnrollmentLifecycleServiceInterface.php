<?php


namespace App\Domain\Enrollments\Services;

use App\Models\Enrollment;

interface EnrollmentLifecycleServiceInterface
{
    public function approve(Enrollment $enrollment): Enrollment;
    public function cancel(Enrollment $enrollment): Enrollment;
}
