<?php

namespace App\Domain\Programs\Repositories;

use App\Models\Program;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProgramRepositoryInterface
{
    public function findById(int $id): ?Program;
    public function findBySlug(string $slug): ?Program;
    public function paginateCatalog(int $perPage = 12): LengthAwarePaginator;
    public function create(array $attributes): Program;
    public function update(Program $program, array $attributes): Program;
    public function delete(Program $program): bool;
}

