<?php

namespace App\Application\Enrollments\DTOs;

use App\Domain\Enrollments\Enums\EnrollmentStatus;
use Illuminate\Http\Request;

final readonly class CancelEnrollmentData
{
    public function __construct(
        public ?string $reason = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reason: $request->filled('reason') ? $request->string('reason')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => EnrollmentStatus::CANCELLED->value,
            'notes' => $this->reason,
        ];
    }
}
