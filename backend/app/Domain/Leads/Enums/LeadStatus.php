<?php

namespace App\Domain\Leads\Enums;

enum LeadStatus: string
{
    case NEW = 'new';
    case CONTACTED = 'contacted';
    case QUALIFIED = 'qualified';
    case CONVERTED = 'converted';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Nouveau',
            self::CONTACTED => 'Contacté',
            self::QUALIFIED => 'Qualifié',
            self::CONVERTED => 'Converti',
            self::CLOSED => 'Fermé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

