<?php

namespace App\Domain\Cohorts\Enums;

enum CohortSessionType: string
{
    case COURSE = 'course';
    case WORKSHOP = 'workshop';
    case LAB = 'lab';
    case EXAM = 'exam';
    case MENTORING = 'mentoring';

    public function label(): string
    {
        return match ($this) {
            self::COURSE => 'Cours',
            self::WORKSHOP => 'Atelier',
            self::LAB => 'Laboratoire',
            self::EXAM => 'Examen',
            self::MENTORING => 'Mentorat',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
