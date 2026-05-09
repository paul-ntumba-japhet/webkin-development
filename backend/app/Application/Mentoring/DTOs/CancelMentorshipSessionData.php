<?php

namespace App\Application\Mentoring\DTOs;

use App\Domain\Mentoring\Enums\MentorshipStatus;
use Illuminate\Http\Request;

final readonly class CancelMentorshipSessionData
{
    public function __construct(
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => MentorshipStatus::CANCELLED->value,
            'notes' => $this->notes,
        ];
    }
}
