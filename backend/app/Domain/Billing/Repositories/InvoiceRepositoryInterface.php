<?php

namespace App\Domain\Billing\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Collection;

interface InvoiceRepositoryInterface
{
    public function findById(int $id): ?Invoice;
    public function findByReference(string $reference): ?Invoice;
    public function listByEnrollmentId(int $enrollmentId): Collection;
    public function create(array $attributes): Invoice;
    public function markAsPaid(Invoice $invoice): Invoice;
}
