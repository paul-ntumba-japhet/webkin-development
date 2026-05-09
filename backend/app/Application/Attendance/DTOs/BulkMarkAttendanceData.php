<?php

namespace App\Application\Attendance\DTOs;

use Illuminate\Http\Request;

final readonly class BulkMarkAttendanceData
{
    /**
     * @param array<int, array<string, mixed>> $entries
     */
    public function __construct(
        public int $scheduleId,
        public array $entries,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            scheduleId: (int) $request->input('schedule_id'),
            entries: array_values((array) $request->input('entries', [])),
        );
    }

    public function toArray(): array
    {
        return [
            'schedule_id' => $this->scheduleId,
            'entries' => $this->entries,
        ];
    }
}
