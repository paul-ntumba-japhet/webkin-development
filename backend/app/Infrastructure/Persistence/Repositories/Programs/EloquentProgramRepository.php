<?php

namespace App\Infrastructure\Persistence\Repositories\Programs;

use App\Domain\Programs\Repositories\ProgramRepositoryInterface;
use App\Models\Program;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;



final class EloquentProgramRepository implements ProgramRepositoryInterface
{
    public function findById(int $id): ?Program
    {
        return Program::query()->find($id);
    }
    public function findBySlug(string $slug): ?Program
    {
        return Program::query()->where('slug', $slug)->first();
    }
    public function paginateCatalog(int $perPage = 12): LengthAwarePaginator
    {
        return Program::query()->where('status', 'published')->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): Program
    {
        return Program::query()->create($attributes);
    }
    public function update(Program $program, array $attributes): Program
    {
        $program->update($attributes);

        return $program->refresh();
    }
    public function delete(Program $program): bool
    {
        return $program->delete();
    }
}
