<?php

namespace App\Domain\SupportMessaging\Enums;

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

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
