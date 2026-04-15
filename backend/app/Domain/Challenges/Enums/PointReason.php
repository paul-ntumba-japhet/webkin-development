<?php

namespace App\Domain\Challenges\Enums;


enum PointReason: string
{
    case CHALLENGE_COMPLETED = 'challenge_completed';
    case ASSIGNMENT_SUBMITTED = 'assignment_submitted';
    case ASSIGNMENT_ACCEPTED = 'assignment_accepted';
    case BONUS_GRANTED = 'bonus_granted';
    case MANUAL_ADJUSTMENT = 'manual_adjustment';
    case PARTICIPATION = 'participation';
    case STREAK_REWARD = 'streak_reward';
    case PENALTY = 'penalty';

    public function label(): string
    {
        return match ($this) {
            self::CHALLENGE_COMPLETED => 'Challenge terminé',
            self::ASSIGNMENT_SUBMITTED => 'Devoir soumis',
            self::ASSIGNMENT_ACCEPTED => 'Devoir accepté',
            self::BONUS_GRANTED => 'Bonus accordé',
            self::MANUAL_ADJUSTMENT => 'Ajustement manuel',
            self::PARTICIPATION => 'Participation',
            self::STREAK_REWARD => 'Récompense de série',
            self::PENALTY => 'Pénalité',
        };
    }

    public function isPositive(): bool
    {
        return $this !== self::PENALTY;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
