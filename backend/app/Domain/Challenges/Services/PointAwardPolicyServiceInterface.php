<?php

namespace App\Domain\Challenges\Services;

use App\Models\ChallengeSubmission;

interface PointAwardPolicyServiceInterface
{
    public function awardForChallengeSubmission(ChallengeSubmission $submission): int;
}
