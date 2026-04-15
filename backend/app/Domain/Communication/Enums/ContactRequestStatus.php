<?php

namespace App\Domain\Communication\Enums;

enum ContactRequestStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Nouveau',
            self::IN_PROGRESS => 'En cours',
            self::RESOLVED => 'Résolu',
            self::CLOSED => 'Fermé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}


