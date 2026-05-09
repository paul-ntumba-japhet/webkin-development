<?php

namespace App\Application\Mentoring\DTOs;

use App\Domain\Mentoring\Enums\MentorshipMode;
use App\Domain\Mentoring\Enums\MentorshipStatus;
use Illuminate\Http\Request;

final readonly class UpdateMentorshipSessionData
{
    public function __construct(
        public string $title,
        public ?string $topic,
        public string $sessionDatetime,
        public int $durationMinutes,
        public MentorshipMode $mode,
        public MentorshipStatus $status,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            topic: $request->filled('topic') ? $request->string('topic')->toString() : null,
            sessionDatetime: $request->date('session_datetime')?->toDateTimeString() ?? now()->toDateTimeString(),
            durationMinutes: (int) $request->input('duration_minutes'),
            mode: MentorshipMode::from($request->input('mode')),
            status: MentorshipStatus::from($request->input('status')),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'topic' => $this->topic,
            'session_datetime' => $this->sessionDatetime,
            'duration_minutes' => $this->durationMinutes,
            'mode' => $this->mode->value,
            'status' => $this->status->value,
            'notes' => $this->notes,
        ];
    }
}
