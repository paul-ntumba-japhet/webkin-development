<?php

namespace App\Domain\Programs\Enums;

enum ProgramShowcaseType: string
{
    case VIDEO = 'video';
    case IMAGE = 'image';
    case CASE_TYPE = 'case_type';
    case DEMO = 'demo';

    public function label(): string
    {
        return match($this) {
            self::VIDEO => 'Vidéo',
            self::IMAGE => 'Image',
            self::CASE_TYPE => 'Cas d\'usage',
            self::DEMO => 'Démo',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
