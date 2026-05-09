<?php

namespace App\Application\Mentoring\DTOs;

use Illuminate\Http\Request;

final readonly class RescheduleMentorshipSessionData
{
    public function __construct(
        public string $sessionDatetime,
        public ?int $durationMinutes = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            sessionDatetime: $request->date('session_datetime')?->toDateTimeString() ?? now()->toDateTimeString(),
            durationMinutes: $request->filled('duration_minutes') ? (int) $request->input('duration_minutes') : null,
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'session_datetime' => $this->sessionDatetime,
            'duration_minutes' => $this->durationMinutes,
            'notes' => $this->notes,
        ], static fn ($value) => $value !== null);
    }
}
