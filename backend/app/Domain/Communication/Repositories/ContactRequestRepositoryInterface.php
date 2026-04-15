<?php

namespace App\Domain\Communication\Repositories;

use App\Models\ContactRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ContactRequestRepositoryInterface
{
    public function findById(int $id): ?ContactRequest;
    public function paginateOpen(int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): ContactRequest;
    public function updateStatus(ContactRequest $request, string $status): ContactRequest;
}
