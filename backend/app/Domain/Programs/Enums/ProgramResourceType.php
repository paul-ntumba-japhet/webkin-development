<?php

namespace App\Domain\Programs\Enums;

enum ProgramResourceType: string
{
    case FILE = 'file';
    case LINK = 'link';
    case VIDEO = 'video';
    case REPOSITORY = 'repository';

    public function label(): string
    {
        return match($this) {
            self::FILE => 'Fichier',
            self::LINK => 'Lien',
            self::VIDEO => 'Vidéo',
            self::REPOSITORY => 'Dépôt',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
