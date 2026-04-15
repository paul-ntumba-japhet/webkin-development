<?php

namespace App\Domain\Communication\Enums;

enum StudentQuestionStatus: string
{
    case OPEN = 'open';
    case ANSWERED = 'answered';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Ouverte',
            self::ANSWERED => 'Répondue',
            self::CLOSED => 'Fermée',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
