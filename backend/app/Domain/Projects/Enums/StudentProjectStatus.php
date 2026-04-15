<?php


namespace App\Domain\Projects\Enums;

enum StudentProjectStatus: string
{
    case DRAFT = 'draft';
    case IN_REVIEW = 'in_review';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Brouillon',
            self::IN_REVIEW => 'En révision',
            self::PUBLISHED => 'Publié',
            self::ARCHIVED => 'Archivé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
