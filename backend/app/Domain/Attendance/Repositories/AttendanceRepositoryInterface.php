<?php

namespace App\Domain\Attendance\Repositories;

use App\Models\Attendance;
use Illuminate\Support\Collection;

interface AttendanceRepositoryInterface
{
    public function findById(int $id): ?Attendance;
    public function findForEnrollmentAndDate(int $enrollmentId, string $date): ?Attendance;
    public function listByCohortAndDate(int $cohortId, string $date): Collection;
    public function createOrUpdate(array $attributes): Attendance;
}


