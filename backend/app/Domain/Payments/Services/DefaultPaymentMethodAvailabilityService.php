<?php

namespace App\Domain\Payments\Services;

use App\Domain\Payments\Services\PaymentMethodAvailabilityServiceInterface;
use App\Models\Invoice;

final class DefaultPaymentMethodAvailabilityService implements PaymentMethodAvailabilityServiceInterface
{
    public function availableForInvoice(Invoice $invoice): array
    {
        return ['cash', 'mobile_money', 'bank_card'];
    }
}
