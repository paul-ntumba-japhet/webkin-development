<?php

namespace App\Domain\Programs\Enums;

enum ProgramResourceStatus: string
{
    case ACTIVE = 'active';
    case HIDDEN = 'hidden';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Actif',
            self::HIDDEN => 'Caché',
            self::ARCHIVED => 'Archivé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
