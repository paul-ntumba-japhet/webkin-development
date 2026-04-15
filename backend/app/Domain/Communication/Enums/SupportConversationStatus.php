<?php

namespace App\Domain\Communication\Enums;

enum SupportConversationStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case WAITING_STUDENT = 'waiting_student';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Ouverte',
            self::IN_PROGRESS => 'En cours',
            self::WAITING_STUDENT => 'En attente de l\'étudiant',
            self::RESOLVED => 'Résolue',
            self::CLOSED => 'Fermée',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

