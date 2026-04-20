<?php

namespace App\Domain\Attendance\Services;

use App\Domain\Attendance\Services\AttendancePolicyServiceInterface;
use DomainException;

final class DefaultAttendancePolicyService implements AttendancePolicyServiceInterface
{
    public function assertRecordable(int $cohortId, string $date): void
    {
        if ($cohortId <= 0 || $date === '') {
            throw new DomainException('La saisie de présence requiert une cohorte et une date valides.');
        }
    }
}
