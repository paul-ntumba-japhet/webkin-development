<?php

namespace App\Application\Billing\DTOs;

use App\Domain\Enrollments\Enums\BillingPeriodStatus;
use Illuminate\Http\Request;

final readonly class CloseBillingPeriodData
{
    public function __construct(
        public ?string $amountPaid = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            amountPaid: $request->filled('amount_paid')
                ? number_format((float) $request->input('amount_paid'), 2, '.', '')
                : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => BillingPeriodStatus::PAID->value,
            'amount_paid' => $this->amountPaid,
            'balance_due' => '0.00',
        ];
    }
}
