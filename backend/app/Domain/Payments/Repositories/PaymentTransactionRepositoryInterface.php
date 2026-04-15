<?php

namespace App\Domain\Payments\Repositories;

use App\Models\PaymentTransaction;
use Illuminate\Support\Collection;

interface PaymentTransactionRepositoryInterface
{
    public function findById(int $id): ?PaymentTransaction;
    public function findByProviderReference(string $reference): ?PaymentTransaction;
    public function listByInvoiceId(int $invoiceId): Collection;
    public function create(array $attributes): PaymentTransaction;
    public function markAsSucceeded(PaymentTransaction $transaction, array $payload = []): PaymentTransaction;
    public function markAsFailed(PaymentTransaction $transaction, array $payload = []): PaymentTransaction;
}


