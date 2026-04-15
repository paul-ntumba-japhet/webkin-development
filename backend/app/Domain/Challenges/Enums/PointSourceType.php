<?php

namespace App\Domain\Challenge\Enums;

enum PointSourceType: string
{
    case CHALLENGE = 'challenge';
    case ASSIGNMENT = 'assignment';
    case BONUS = 'bonus';
    case MANUAL = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::CHALLENGE => 'Challenge',
            self::ASSIGNMENT => 'Devoir',
            self::BONUS => 'Bonus',
            self::MANUAL => 'Ajustement manuel',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
