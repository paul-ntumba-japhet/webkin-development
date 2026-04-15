<?php

namespace App\Infrastructure\Persistence\Repositories\Communication;

use App\Domain\Communication\Repositories\ContactRequestRepositoryInterface;
use App\Models\ContactRequest;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentContactRequestRepository implements ContactRequestRepositoryInterface
{
    public function findById(int $id): ?ContactRequest
    {
        return ContactRequest::query()->find($id);
    }
    public function paginateOpen(int $perPage = 20): LengthAwarePaginator
    {
        return ContactRequest::query()->whereIn('status', ['pending', 'open'])->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): ContactRequest
    {
        return ContactRequest::query()->create($attributes);
    }
    public function updateStatus(ContactRequest $request, string $status): ContactRequest
    {
        $modelVar = $request;
        $modelVar->update(['status' => $status]);

        return $modelVar->refresh();
    }
}
