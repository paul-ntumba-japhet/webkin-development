<?php

namespace App\Infrastructure\Persistence\Repositories\Challenges;

use App\Domain\Challenges\Repositories\PointTransactionRepositoryInterface;
use App\Models\PointTransaction;
use Illuminate\Support\Collection;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentPointTransactionRepository implements PointTransactionRepositoryInterface
{
    public function listByUserId(int $userId): Collection
    {
        // TODO: adapter la requête selon les colonnes réelles du modèle.
        throw new \RuntimeException('Not implemented yet.');
    }
    public function create(array $attributes): PointTransaction
    {
        return PointTransaction::query()->create($attributes);
    }
    public function sumBalanceForUser(int $userId): int
    {
        return (int) PointTransaction::query()->where('user_id', $userId)->sum('points');
    }
}
