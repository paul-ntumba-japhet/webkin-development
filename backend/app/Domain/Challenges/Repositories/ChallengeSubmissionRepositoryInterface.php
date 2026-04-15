<?php

namespace App\Domain\Challenges\Repositories;

use App\Models\ChallengeSubmission;
use Illuminate\Support\Collection;

interface ChallengeSubmissionRepositoryInterface
{
    public function findById(int $id): ?ChallengeSubmission;
    public function findLatestForChallengeAndUser(int $challengeId, int $userId): ?ChallengeSubmission;
    public function listByChallengeId(int $challengeId): Collection;
    public function create(array $attributes): ChallengeSubmission;
    public function updateStatus(ChallengeSubmission $submission, string $status): ChallengeSubmission;
}
