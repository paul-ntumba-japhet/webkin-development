<?php

namespace App\Domain\Challenges\Enums;

enum ChallengeCategory: string
{
    case FRONTEND = 'frontend';
    case BACKEND = 'backend';
    case FULLSTACK = 'fullstack';
    case MOBILE = 'mobile';
    case DATABASE = 'database';
    case DEVOPS = 'devops';
    case ALGORITHMS = 'algorithms';
    case UI_UX = 'ui_ux';

    public function label(): string
    {
        return match ($this) {
            self::FRONTEND => 'Frontend',
            self::BACKEND => 'Backend',
            self::FULLSTACK => 'Fullstack',
            self::MOBILE => 'Mobile',
            self::DATABASE => 'Base de données',
            self::DEVOPS => 'DevOps',
            self::ALGORITHMS => 'Algorithmes',
            self::UI_UX => 'UI/UX',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
