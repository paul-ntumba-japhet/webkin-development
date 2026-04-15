<?php

namespace App\Domain\Attendance\Enums;

enum AttendanceStatus: string
{
    case PRESENT = 'present';
    case ABSENT = 'absent';
    case LATE = 'late';
    case EXCUSED = 'excused';

    public function label() : string
    {
        return match ($this) {
            self::PRESENT => 'Présent',
            self::ABSENT => 'Absent',
            self::LATE => 'En retard',
            self::EXCUSED => 'Excusé',
        };
    }

    public static function values() : array
    {
        return array_column(self::cases(), 'value');
    }
}
