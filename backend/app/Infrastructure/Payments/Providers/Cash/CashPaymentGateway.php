<?php

namespace App\Infrastructure\Payments\Providers\Cash;

use App\Infrastructure\Payments\Contracts\PaymentGatewayInterface;
use App\Models\Invoice;
use App\Models\PaymentTransaction;

final class CashPaymentGateway implements PaymentGatewayInterface
{
    public function code(): string
    {
        return 'cash';
    }

    public function initiate(Invoice $invoice, array $payload = []): array
    {
        return [
            'provider_reference' => 'CASH-' . now()->format('YmdHis'),
            'status' => 'pending',
            'payload' => $payload,
        ];
    }

    public function confirm(PaymentTransaction $transaction, array $payload = []): array
    {
        return [
            'provider_reference' => $transaction->provider_reference,
            'status' => 'succeeded',
            'payload' => $payload,
        ];
    }
}
