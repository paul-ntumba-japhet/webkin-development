<?php

namespace App\Domain\Payments\Services;

use App\Models\Invoice;
use App\Models\PaymentTransaction;

interface PaymentLifecycleServiceInterface
{
    public function initiate(Invoice $invoice, string $gatewayCode, array $payload = []): PaymentTransaction;
    public function confirm(PaymentTransaction $transaction, array $payload = []): PaymentTransaction;
}
