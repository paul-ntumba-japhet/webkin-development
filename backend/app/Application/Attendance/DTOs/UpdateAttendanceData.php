<?php

namespace App\Application\Attendance\DTOs;

use App\Domain\Attendance\Enums\AttendanceStatus;
use Illuminate\Http\Request;

final readonly class UpdateAttendanceData
{
    public function __construct(
        public AttendanceStatus $status,
        public ?string $checkInTime = null,
        public ?string $remark = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            status: AttendanceStatus::from($request->input('status')),
            checkInTime: $request->date('check_in_time')?->toDateTimeString(),
            remark: $request->filled('remark') ? $request->string('remark')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
            'check_in_time' => $this->checkInTime,
            'remark' => $this->remark,
        ];
    }
}
