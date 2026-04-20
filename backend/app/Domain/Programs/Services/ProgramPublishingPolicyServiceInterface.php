<?php

namespace App\Domain\Programs\Services;

use App\Models\Program;

interface ProgramPublishingPolicyServiceInterface
{
    public function assertPublishable(Program $program): void;
}

