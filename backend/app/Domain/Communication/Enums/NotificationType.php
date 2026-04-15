<?php

namespace App\Domain\Communication\Enums;



enum NotificationType: string
{
    case SYSTEM = 'system';
    case BILLING = 'billing';
    case ACADEMIC = 'academic';
    case MARKETING = 'marketing';
    case SUPPORT = 'support';

    public function label(): string
    {
        return match ($this) {
            self::SYSTEM => 'Système',
            self::BILLING => 'Facturation',
            self::ACADEMIC => 'Académique',
            self::MARKETING => 'Marketing',
            self::SUPPORT => 'Support',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
