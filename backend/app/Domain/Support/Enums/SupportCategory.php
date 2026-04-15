<?php

namespace App\Domain\Support\Enums;

enum SupportCategory: string
{
    case TECHNICAL = 'technical';
    case BILLING = 'billing';
    case ENROLLMENT = 'enrollment';
    case SCHEDULING = 'scheduling';
    case ACADEMIC = 'academic';
    case ACCESS = 'access';
    case GENERAL = 'general';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::TECHNICAL => 'Technique',
            self::BILLING => 'Facturation',
            self::ENROLLMENT => 'Inscription',
            self::SCHEDULING => 'Planning',
            self::ACADEMIC => 'Académique',
            self::ACCESS => 'Accès',
            self::GENERAL => 'Générale',
            self::OTHER => 'Autre',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
