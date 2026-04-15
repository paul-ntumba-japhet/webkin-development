<?php

namespace App\Domain\Media\Enums;

enum MediaType: string
{
    case VIDEO = 'video';
    case IMAGE = 'image';
    case DOCUMENT = 'document';
    case AUDIO = 'audio';

    public function label(): string
    {
        return match($this) {
            self::VIDEO => 'Video',
            self::IMAGE => 'Image',
            self::DOCUMENT => 'Document',
            self::AUDIO => 'Audio',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::VIDEO => 'fa-solid fa-video',
            self::IMAGE => 'fa-solid fa-image',
            self::DOCUMENT => 'fa-solid fa-file',
            self::AUDIO => 'fa-solid fa-music',
        };
    }

    public static function values(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }
}
