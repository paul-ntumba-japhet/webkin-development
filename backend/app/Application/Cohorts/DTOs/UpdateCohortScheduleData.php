<?php

namespace App\Application\Cohorts\DTOs;

use App\Domain\Cohorts\Enums\CohortSessionStatus;
use App\Domain\Cohorts\Enums\CohortSessionType;
use Illuminate\Http\Request;

final readonly class UpdateCohortScheduleData
{
    public function __construct(
        public ?int $cohortWeeklyScheduleId,
        public ?int $instructorId,
        public ?int $moduleId,
        public ?int $lessonId,
        public ?int $roomId,
        public string $scheduledDate,
        public ?string $startTime,
        public ?string $endTime,
        public CohortSessionType $sessionType,
        public CohortSessionStatus $status,
        public ?string $title = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            cohortWeeklyScheduleId: $request->filled('cohort_weekly_schedule_id') ? (int) $request->input('cohort_weekly_schedule_id') : null,
            instructorId: $request->filled('instructor_id') ? (int) $request->input('instructor_id') : null,
            moduleId: $request->filled('module_id') ? (int) $request->input('module_id') : null,
            lessonId: $request->filled('lesson_id') ? (int) $request->input('lesson_id') : null,
            roomId: $request->filled('room_id') ? (int) $request->input('room_id') : null,
            scheduledDate: $request->date('scheduled_date')?->toDateString() ?? now()->toDateString(),
            startTime: $request->input('start_time'),
            endTime: $request->input('end_time'),
            sessionType: CohortSessionType::from($request->input('session_type')),
            status: CohortSessionStatus::from($request->input('status')),
            title: $request->filled('title') ? $request->string('title')->toString() : null,
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'cohort_weekly_schedule_id' => $this->cohortWeeklyScheduleId,
            'instructor_id' => $this->instructorId,
            'module_id' => $this->moduleId,
            'lesson_id' => $this->lessonId,
            'room_id' => $this->roomId,
            'scheduled_date' => $this->scheduledDate,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'session_type' => $this->sessionType->value,
            'status' => $this->status->value,
            'title' => $this->title,
            'notes' => $this->notes,
        ];
    }
}
