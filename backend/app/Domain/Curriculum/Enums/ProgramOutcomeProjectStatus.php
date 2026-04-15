<?php


namespace App\Domain\Curriculum\Enums;

enum ProgramOutcomeProjectStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Brouillon',
            self::PUBLISHED => 'Publié',
            self::ARCHIVED => 'Archivé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
