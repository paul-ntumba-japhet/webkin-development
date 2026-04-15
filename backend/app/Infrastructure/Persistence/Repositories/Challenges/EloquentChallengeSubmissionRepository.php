<?php

namespace App\Infrastructure\Persistence\Repositories\Challenges;

use App\Domain\Challenges\Repositories\ChallengeSubmissionRepositoryInterface;
use App\Models\ChallengeSubmission;
use Illuminate\Support\Collection;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentChallengeSubmissionRepository implements ChallengeSubmissionRepositoryInterface
{
    public function findById(int $id): ?ChallengeSubmission
    {
        return ChallengeSubmission::query()->find($id);
    }
    public function findLatestForChallengeAndUser(int $challengeId, int $userId): ?ChallengeSubmission
    {
        return ChallengeSubmission::query()->where('challenge_id', $challengeId)->where('user_id', $userId)->latest('id')->first();
    }
    public function listByChallengeId(int $challengeId): Collection
    {
        return ChallengeSubmission::query()->where('challenge_id', $challengeId)->latest('id')->get();
    }
    public function create(array $attributes): ChallengeSubmission
    {
        return ChallengeSubmission::query()->create($attributes);
    }
    public function updateStatus(ChallengeSubmission $submission, string $status): ChallengeSubmission
    {
        $modelVar = $submission;
        $modelVar->update(['status' => $status]);

        return $modelVar->refresh();
    }
}
