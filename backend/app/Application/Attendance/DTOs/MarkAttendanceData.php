<?php

namespace App\Application\Attendance\DTOs;

use App\Domain\Attendance\Enums\AttendanceStatus;
use Illuminate\Http\Request;

final readonly class MarkAttendanceData
{
    public function __construct(
        public int $enrollmentId,
        public int $scheduleId,
        public AttendanceStatus $status,
        public ?string $checkInTime = null,
        public ?string $remark = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            enrollmentId: (int) $request->input('enrollment_id'),
            scheduleId: (int) $request->input('schedule_id'),
            status: AttendanceStatus::from($request->input('status')),
            checkInTime: $request->date('check_in_time')?->toDateTimeString(),
            remark: $request->filled('remark') ? $request->string('remark')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'enrollment_id' => $this->enrollmentId,
            'schedule_id' => $this->scheduleId,
            'status' => $this->status->value,
            'check_in_time' => $this->checkInTime,
            'remark' => $this->remark,
        ];
    }
}
