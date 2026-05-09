<?php

namespace App\Application\Cohorts\DTOs;

use App\Domain\Cohorts\Enums\DayOfWeek;
use Illuminate\Http\Request;

final readonly class UpdateCohortWeeklyScheduleData
{
    public function __construct(
        public DayOfWeek $dayOfWeek,
        public ?string $startTime,
        public ?string $endTime,
        public ?int $roomId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            dayOfWeek: DayOfWeek::from($request->input('day_of_week')),
            startTime: $request->input('start_time'),
            endTime: $request->input('end_time'),
            roomId: $request->filled('room_id') ? (int) $request->input('room_id') : null,
        );
    }

    public function toArray(): array
    {
        return [
            'day_of_week' => $this->dayOfWeek->value,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'room_id' => $this->roomId,
        ];
    }
}
