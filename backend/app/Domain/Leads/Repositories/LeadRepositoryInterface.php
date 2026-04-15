<?php

namespace App\Domain\Leads\Repositories;

use App\Models\Lead;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LeadRepositoryInterface
{
    public function findById(int $id): ?Lead;
    public function paginatePipeline(int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): Lead;
    public function update(Lead $lead, array $attributes): Lead;
    public function convert(Lead $lead): Lead;
}
