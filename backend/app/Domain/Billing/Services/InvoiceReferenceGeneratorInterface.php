<?php

namespace App\Domain\Billing\Services;



interface InvoiceReferenceGeneratorInterface
{
    public function generate(): string;
}
