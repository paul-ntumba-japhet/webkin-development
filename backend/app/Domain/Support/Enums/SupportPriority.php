<?php

namespace App\Domain\Support\Enums;

enum SupportPriority: string
{
    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';
    case URGENT = 'urgent';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Faible',
            self::NORMAL => 'Normale',
            self::HIGH => 'Haute',
            self::URGENT => 'Urgente',
        };
    }

    public function rank(): int
    {
        return match ($this) {
            self::LOW => 1,
            self::NORMAL => 2,
            self::HIGH => 3,
            self::URGENT => 4,
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
