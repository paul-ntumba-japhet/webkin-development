<?php


namespace App\Infrastructure\Payments\Contracts;

use App\Models\Invoice;
use App\Models\PaymentTransaction;

interface PaymentGatewayInterface
{
    public function code(): string;

    public function initiate(Invoice $invoice, array $payload = []): array;

    public function confirm(PaymentTransaction $transaction, array $payload = []): array;

}
