<?php

namespace App\Domain\Programs\Repositories;

use App\Models\ProgramShowcase;
use Illuminate\Support\Collection;

interface ProgramShowcaseRepositoryInterface
{
    public function findById(int $id): ?ProgramShowcase;
    public function listPublishedByProgramId(int $programId): Collection;
    public function create(array $attributes): ProgramShowcase;
    public function update(ProgramShowcase $showcase, array $attributes): ProgramShowcase;
    public function delete(ProgramShowcase $showcase): bool;
}
