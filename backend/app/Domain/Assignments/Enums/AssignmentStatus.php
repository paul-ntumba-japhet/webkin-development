<?php

namespace App\Domain\Assignments\Enums;

enum SubmissionStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case REVIEWED = 'reviewed';
    case RETURNED = 'returned';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Brouillon',
            self::SUBMITTED => 'Soumis',
            self::REVIEWED => 'Révisé',
            self::RETURNED => 'Retour',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
