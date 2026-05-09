<?php

namespace App\Application\Billing\DTOs;

use Illuminate\Http\Request;

final readonly class MarkInvoiceAsPaidData
{
    public function __construct(
        public ?string $paidAt = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            paidAt: $request->date('paid_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'paid_at' => $this->paidAt,
            'notes' => $this->notes,
        ];
    }
}
