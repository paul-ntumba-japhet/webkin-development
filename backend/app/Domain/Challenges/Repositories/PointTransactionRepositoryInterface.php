<?php

namespace App\Domain\Challenges\Repositories;

use App\Models\PointTransaction;
use Illuminate\Support\Collection;

interface PointTransactionRepositoryInterface
{
    public function listByUserId(int $userId): Collection;
    public function create(array $attributes): PointTransaction;
    public function sumBalanceForUser(int $userId): int;
}
