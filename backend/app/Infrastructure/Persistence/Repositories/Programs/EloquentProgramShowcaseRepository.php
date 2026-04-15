<?php

namespace App\Infrastructure\Persistence\Repositories\Programs;

use App\Domain\Programs\Repositories\ProgramShowcaseRepositoryInterface;
use App\Models\ProgramShowcase;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentProgramShowcaseRepository implements ProgramShowcaseRepositoryInterface
{
    public function findById(int $id): ?ProgramShowcase
    {
        return ProgramShowcase::query()->find($id);
    }
    public function listPublishedByProgramId(int $programId): Collection
    {
        return ProgramShowcase::query()->where('program_id', $programId)->where('status', 'published')->orderBy('position')->get();
    }
    public function create(array $attributes): ProgramShowcase
    {
        return ProgramShowcase::query()->create($attributes);
    }
    public function update(ProgramShowcase $showcase, array $attributes): ProgramShowcase
    {
        $showcase->update($attributes);

        return $showcase->refresh();
    }
    public function delete(ProgramShowcase $showcase): bool
    {
        return $showcase->delete();
    }
}
