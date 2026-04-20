<?php

namespace App\Domain\Payments\Services;

use App\Models\Invoice;

interface PaymentMethodAvailabilityServiceInterface
{
    public function availableForInvoice(Invoice $invoice): array;
}


