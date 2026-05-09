<?php

namespace App\Application\Mentoring\DTOs;

use App\Domain\Mentoring\Enums\MentorshipMode;
use App\Domain\Mentoring\Enums\MentorshipStatus;
use Illuminate\Http\Request;

final readonly class CreateMentorshipSessionData
{
    public function __construct(
        public int $mentorId,
        public int $studentId,
        public ?int $enrollmentId,
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
            mentorId: (int) $request->input('mentor_id'),
            studentId: (int) $request->input('student_id'),
            enrollmentId: $request->filled('enrollment_id') ? (int) $request->input('enrollment_id') : null,
            title: $request->string('title')->toString(),
            topic: $request->filled('topic') ? $request->string('topic')->toString() : null,
            sessionDatetime: $request->date('session_datetime')?->toDateTimeString() ?? now()->toDateTimeString(),
            durationMinutes: (int) $request->input('duration_minutes'),
            mode: MentorshipMode::from($request->input('mode')),
            status: MentorshipStatus::from($request->input('status', MentorshipStatus::SCHEDULED->value)),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'mentor_id' => $this->mentorId,
            'student_id' => $this->studentId,
            'enrollment_id' => $this->enrollmentId,
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
