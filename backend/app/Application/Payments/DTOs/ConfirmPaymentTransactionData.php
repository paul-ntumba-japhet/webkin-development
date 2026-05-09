<?php

namespace App\Application\Payments\DTOs;

use App\Domain\Payments\Enums\PaymentTransactionStatus;
use Illuminate\Http\Request;

final readonly class ConfirmPaymentTransactionData
{
    /**
     * @param array<string, mixed>|null $metadata
     */
    public function __construct(
        public ?string $externalReference,
        public ?string $paidAt,
        public ?string $confirmedAt,
        public ?array $metadata,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            externalReference: $request->filled('external_reference') ? $request->string('external_reference')->toString() : null,
            paidAt: $request->date('paid_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            confirmedAt: $request->date('confirmed_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            metadata: $request->input('metadata'),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'external_reference' => $this->externalReference,
            'paid_at' => $this->paidAt,
            'confirmed_at' => $this->confirmedAt,
            'status' => PaymentTransactionStatus::SUCCEEDED->value,
            'metadata' => $this->metadata,
            'notes' => $this->notes,
        ];
    }
}
