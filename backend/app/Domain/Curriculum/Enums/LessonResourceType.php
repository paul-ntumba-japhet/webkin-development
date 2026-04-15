<?php

namespace App\Domain\Curriculum\Enums;

enum LessonResourceType: string
{
    case DOCUMENT = 'document';
    case LINK = 'link';
    case VIDEO = 'video';
    case CODE = 'code';

    public function label(): string
    {
        return match ($this) {
            self::DOCUMENT => 'Document',
            self::LINK => 'Lien',
            self::VIDEO => 'Vidéo',
            self::CODE => 'Code',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
