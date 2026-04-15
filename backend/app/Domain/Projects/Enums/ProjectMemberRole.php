<?php

namespace App\Domain\Assignments\Enums;

enum ProjectMemberRole: string
{
    case LEADER = 'leader';
    case DEVELOPER = 'developer';
    case DESIGNER = 'designer';
    case QA = 'qa';
    case REVIEWER = 'reviewer';
    case OBSERVER = 'observer';

    public function label(): string
    {
        return match ($this) {
            self::LEADER => 'Chef de projet',
            self::DEVELOPER => 'Développeur',
            self::DESIGNER => 'Designer',
            self::QA => 'QA',
            self::REVIEWER => 'Reviewer',
            self::OBSERVER => 'Observateur',
        };
    }

    public function canManageProject(): bool
    {
        return $this === self::LEADER;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
