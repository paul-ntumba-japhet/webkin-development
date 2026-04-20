<?php


namespace App\Domain\Challenges\Services;

use App\Domain\Challenges\Services\PointAwardPolicyServiceInterface;
//use App\Models\Challenge;
use App\Models\ChallengeSubmission;

final class DefaultPointAwardPolicyService implements PointAwardPolicyServiceInterface
{
    public function awardForChallengeSubmission(ChallengeSubmission $submission): int
    {
        return (int) ($submission->points_awarded ?? 10);
    }
}
