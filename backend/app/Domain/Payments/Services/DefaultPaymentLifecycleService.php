<?php

namespace App\Application\Payments\Services;

use App\Domain\Payments\Repositories\PaymentTransactionRepositoryInterface;
use App\Domain\Payments\Services\PaymentLifecycleServiceInterface;
use App\Infrastructure\Payments\Services\PaymentGatewayRegistry;
use App\Models\Invoice;
use App\Models\PaymentTransaction;

final class DefaultPaymentLifecycleService implements PaymentLifecycleServiceInterface
{
    public function __construct(
        private readonly PaymentTransactionRepositoryInterface $transactions,
        private readonly PaymentGatewayRegistry $gatewayRegistry,
    ) {
    }

    public function initiate(Invoice $invoice, string $gatewayCode, array $payload = []): PaymentTransaction
    {
        $gateway = $this->gatewayRegistry->get($gatewayCode);
        $result = $gateway->initiate($invoice, $payload);

        return $this->transactions->create([
            'invoice_id' => $invoice->id,
            'provider_reference' => $result['provider_reference'] ?? null,
            'status' => $result['status'] ?? 'pending',
            'provider_payload' => $result['payload'] ?? $payload,
            'payment_method' => $gatewayCode,
        ]);
    }

    public function confirm(PaymentTransaction $transaction, array $payload = []): PaymentTransaction
    {
        $gateway = $this->gatewayRegistry->get((string) $transaction->payment_method);
        $result = $gateway->confirm($transaction, $payload);

        return ($result['status'] ?? 'failed') === 'succeeded'
            ? $this->transactions->markAsSucceeded($transaction, $result['payload'] ?? $payload)
            : $this->transactions->markAsFailed($transaction, $result['payload'] ?? $payload);
    }
}
