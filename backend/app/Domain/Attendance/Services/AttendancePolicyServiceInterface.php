<?php

namespace App\Domain\Attendance\Services;



interface AttendancePolicyServiceInterface
{
    public function assertRecordable(int $cohortId, string $date): void;
}
