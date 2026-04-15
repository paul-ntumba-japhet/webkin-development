<?php

namespace App\Domain\Programs\Repositories;

use App\Models\ProgramModule;
use Illuminate\Support\Collection;
use App\Models\Program;

interface ProgramModuleRepositoryInterface
{
    public function findById(int $id): ?ProgramModule;
    public function listByProgramId(int $programId): Collection;
    public function createManyForProgram(Program $program, array $rows): Collection;
    public function update(ProgramModule $module, array $attributes): ProgramModule;
    public function delete(ProgramModule $module): bool;
}
