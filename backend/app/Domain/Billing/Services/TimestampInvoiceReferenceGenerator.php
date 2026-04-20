<?php

namespace App\Domain\Billing\Services;

use App\Domain\Billing\Services\InvoiceReferenceGeneratorInterface;
use Illuminate\Support\Str;

final class TimestampInvoiceReferenceGenerator implements InvoiceReferenceGeneratorInterface
{
    public function generate(): string
    {
        return 'INV-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6));
    }
}

