<?php

namespace App\Domain\Cohorts\Services;


interface CohortSchedulingPolicyServiceInterface
{
    public function assertSchedulable(array $rows): void;
}
