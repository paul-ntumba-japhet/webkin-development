<?php

namespace App\Domain\Cohorts\Enums;

enum CohortSessionStatus: string
{
    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case POSTPONED = 'postponed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Planifiée',
            self::COMPLETED => 'Terminée',
            self::POSTPONED => 'Reportée',
            self::CANCELLED => 'Annulée',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
