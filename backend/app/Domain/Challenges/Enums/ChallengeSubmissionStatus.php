<?php

namespace App\Domain\Challenges\Enums;

enum ChallengeSubmissionStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case REVIEWED = 'reviewed';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Brouillon',
            self::SUBMITTED => 'Soumis',
            self::REVIEWED => 'Révisé',
            self::REJECTED => 'Rejeté',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
