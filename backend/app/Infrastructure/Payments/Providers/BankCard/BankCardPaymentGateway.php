<?php

namespace App\Infrastructure\Payments\Providers\BankCard;

use App\Infrastructure\Payments\Contracts\PaymentGatewayInterface;
use App\Models\Invoice;
use App\Models\PaymentTransaction;

final class BankCardPaymentGateway implements PaymentGatewayInterface
{
    public function code(): string
    {
        return 'bank_card';
    }

    public function initiate(Invoice $invoice, array $payload = []): array
    {
        return [
            'provider_reference' => 'CARD-' . now()->format('YmdHis'),
            'status' => 'pending',
            'payload' => $payload,
        ];
    }

    public function confirm(PaymentTransaction $transaction, array $payload = []): array
    {
        return [
            'provider_reference' => $transaction->provider_reference,
            'status' => $payload['status'] ?? 'succeeded',
            'payload' => $payload,
        ];
    }
}
