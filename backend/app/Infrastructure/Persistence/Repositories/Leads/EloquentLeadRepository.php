<?php

namespace App\Infrastructure\Persistence\Repositories\Leads;

use App\Domain\Leads\Repositories\LeadRepositoryInterface;
use App\Models\Lead;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentLeadRepository implements LeadRepositoryInterface
{
    public function findById(int $id): ?Lead
    {
        return Lead::query()->find($id);
    }
    public function paginatePipeline(int $perPage = 20): LengthAwarePaginator
    {
        return Lead::query()->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): Lead
    {
        return Lead::query()->create($attributes);
    }
    public function update(Lead $lead, array $attributes): Lead
    {
        $lead->update($attributes);

        return $lead->refresh();
    }
    public function convert(Lead $lead): Lead
    {
        $lead->update(['status' => 'converted']);

        return $lead->refresh();
    }
}
