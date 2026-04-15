<?php

namespace App\Infrastructure\Persistence\Repositories\Challenges;

use App\Domain\Challenges\Repositories\ChallengeRepositoryInterface;
use App\Models\Challenge;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentChallengeRepository implements ChallengeRepositoryInterface
{
    public function findById(int $id): ?Challenge
    {
        return Challenge::query()->find($id);
    }
    public function listPublished(int $perPage = 12): LengthAwarePaginator
    {
        return Challenge::query()->where('status', 'published')->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): Challenge
    {
        return Challenge::query()->create($attributes);
    }
    public function update(Challenge $challenge, array $attributes): Challenge
    {
        $challenge->update($attributes);

        return $challenge->refresh();
    }
    public function delete(Challenge $challenge): bool
    {
        return $challenge->delete();
    }
}
