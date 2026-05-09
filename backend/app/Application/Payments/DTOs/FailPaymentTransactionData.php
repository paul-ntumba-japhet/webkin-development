<?php

namespace App\Application\Payments\DTOs;

use App\Domain\Payments\Enums\PaymentTransactionStatus;
use Illuminate\Http\Request;

final readonly class FailPaymentTransactionData
{
    /**
     * @param array<string, mixed>|null $metadata
     */
    public function __construct(
        public ?string $failureReason = null,
        public ?array $metadata = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            failureReason: $request->filled('failure_reason') ? $request->string('failure_reason')->toString() : null,
            metadata: $request->input('metadata'),
        );
    }

    public function toArray(): array
    {
        return [
            'status' => PaymentTransactionStatus::FAILED->value,
            'notes' => $this->failureReason,
            'metadata' => $this->metadata,
        ];
    }
}
