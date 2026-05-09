<?php

namespace App\Application\Payments\DTOs;

use App\Domain\Payments\Enums\PaymentTransactionStatus;
use Illuminate\Http\Request;

final readonly class RefundPaymentTransactionData
{
    /**
     * @param array<string, mixed>|null $metadata
     */
    public function __construct(
        public ?string $reason = null,
        public ?array $metadata = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reason: $request->filled('reason') ? $request->string('reason')->toString() : null,
            metadata: $request->input('metadata'),
        );
    }

    public function toArray(): array
    {
        return [
            'status' => PaymentTransactionStatus::REFUNDED->value,
            'notes' => $this->reason,
            'metadata' => $this->metadata,
        ];
    }
}
