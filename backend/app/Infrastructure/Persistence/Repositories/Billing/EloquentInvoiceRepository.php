<?php

namespace App\Infrastructure\Persistence\Repositories\Billing;

use App\Domain\Billing\Repositories\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentInvoiceRepository implements InvoiceRepositoryInterface
{
    public function findById(int $id): ?Invoice
    {
        return Invoice::query()->find($id);
    }
    public function findByReference(string $reference): ?Invoice
    {
        return Invoice::query()->where('reference', $reference)->first();
    }
    public function listByEnrollmentId(int $enrollmentId): Collection
    {
        return Invoice::query()->where('enrollment_id', $enrollmentId)->latest('id')->get();
    }
    public function create(array $attributes): Invoice
    {
        return Invoice::query()->create($attributes);
    }
    public function markAsPaid(Invoice $invoice): Invoice
    {
        $invoice->update(['status' => 'paid', 'paid_at' => now()]);

        return $invoice->refresh();
    }
}
