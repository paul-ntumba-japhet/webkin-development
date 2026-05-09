<?php

namespace App\Application\Enrollments\DTOs;

use App\Domain\Enrollments\Enums\EnrollmentPaymentStatus;
use Illuminate\Http\Request;

final readonly class ChangeEnrollmentPaymentStatusData
{
    public function __construct(
        public EnrollmentPaymentStatus $paymentStatus,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            paymentStatus: EnrollmentPaymentStatus::from($request->input('payment_status')),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'payment_status' => $this->paymentStatus->value,
            'notes' => $this->notes,
        ];
    }
}
