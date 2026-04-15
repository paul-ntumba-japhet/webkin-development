<?php

namespace App\Domain\Challenges\Repositories;

use App\Models\Challenge;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ChallengeRepositoryInterface
{
    public function findById(int $id): ?Challenge;
    public function listPublished(int $perPage = 12): LengthAwarePaginator;
    public function create(array $attributes): Challenge;
    public function update(Challenge $challenge, array $attributes): Challenge;
    public function delete(Challenge $challenge): bool;
}


