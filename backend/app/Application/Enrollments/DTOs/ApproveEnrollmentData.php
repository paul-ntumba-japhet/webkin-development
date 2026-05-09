<?php

namespace App\Application\Enrollments\DTOs;

use App\Domain\Enrollments\Enums\EnrollmentStatus;
use Illuminate\Http\Request;

final readonly class ApproveEnrollmentData
{
    public function __construct(
        public int $validatedByUserId,
        public ?string $validatedAt = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            validatedByUserId: (int) $request->input('validated_by_user_id'),
            validatedAt: $request->date('validated_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => EnrollmentStatus::ACTIVE->value,
            'validated_by_user_id' => $this->validatedByUserId,
            'validated_at' => $this->validatedAt,
            'notes' => $this->notes,
        ];
    }
}
