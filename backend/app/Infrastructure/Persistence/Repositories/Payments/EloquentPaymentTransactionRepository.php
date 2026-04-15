<?php


namespace App\Infrastructure\Persistence\Repositories\Payments;

use App\Domain\Payments\Repositories\PaymentTransactionRepositoryInterface;
use App\Models\PaymentTransaction;
use Illuminate\Support\Collection;

final class EloquentPaymentTransactionRepository implements PaymentTransactionRepositoryInterface
{
    public function findById(int $id): ?PaymentTransaction
    {
        return PaymentTransaction::query()->find($id);
    }
    public function findByProviderReference(string $reference): ?PaymentTransaction
    {
        return PaymentTransaction::query()->where('provider_reference', $reference)->first();
    }
    public function listByInvoiceId(int $invoiceId): Collection
    {
        return PaymentTransaction::query()->where('invoice_id', $invoiceId)->latest('id')->get();
    }
    public function create(array $attributes): PaymentTransaction
    {
        return PaymentTransaction::query()->create($attributes);
    }
    public function markAsSucceeded(PaymentTransaction $transaction, array $payload = []): PaymentTransaction
    {
        $transaction->update([
            'status' => 'succeeded',
            'provider_payload' => array_merge($transaction->provider_payload ?? [], $payload),
            'confirmed_at' => now(),
        ]);

        return $transaction->refresh();
    }
    public function markAsFailed(PaymentTransaction $transaction, array $payload = []): PaymentTransaction
    {
        $transaction->update([
            'status' => 'failed',
            'provider_payload' => array_merge($transaction->provider_payload ?? [], $payload),
        ]);

        return $transaction->refresh();
    }
}
