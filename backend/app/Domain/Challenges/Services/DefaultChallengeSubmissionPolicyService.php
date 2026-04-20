<?php

namespace App\Domain\Challenges\Services;

use App\Domain\Challenges\Services\ChallengeSubmissionPolicyServiceInterface;
use App\Models\Challenge;
use DomainException;

final class DefaultChallengeSubmissionPolicyService implements ChallengeSubmissionPolicyServiceInterface
{
    public function assertSubmittable(Challenge $challenge, int $userId): void
    {
        if (! empty($challenge->end_at) && now()->greaterThan($challenge->end_at)) {
            throw new DomainException('Le challenge est terminé.');
        }
    }
}


