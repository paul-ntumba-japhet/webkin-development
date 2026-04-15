<?php

namespace App\Infrastructure\Persistence\Repositories\Programs;

use App\Domain\Programs\Repositories\ProgramModuleRepositoryInterface;
use App\Models\ProgramModule;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Program;

final class EloquentProgramModuleRepository implements ProgramModuleRepositoryInterface
{
    public function findById(int $id): ?ProgramModule
    {
        return ProgramModule::query()->find($id);
    }
    public function listByProgramId(int $programId): Collection
    {
        return ProgramModule::query()->where('program_id', $programId)->orderBy('position')->get();
    }
    public function createManyForProgram(Program $program, array $rows): Collection
    {
        return DB::transaction(function () use ($program, $rows) {
            $items = collect();

            foreach ($rows as $row) {
                $row['program_id'] = $program->id;
                $items->push(ProgramModule::query()->create($row));
            }

            return $items;
        });
    }
    public function update(ProgramModule $module, array $attributes): ProgramModule
    {
        $module->update($attributes);

        return $module->refresh();
    }
    public function delete(ProgramModule $module): bool
    {
        return $module->delete();
    }
}
