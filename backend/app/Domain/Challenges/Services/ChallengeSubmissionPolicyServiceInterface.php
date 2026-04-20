<?php

namespace App\Domain\Challenges\Services;

use App\Models\Challenge;

interface ChallengeSubmissionPolicyServiceInterface
{
    public function assertSubmittable(Challenge $challenge, int $userId): void;
}
