<?php

namespace App\Domain\Assignments\Enums;


enum AssignmentSubmissionStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case LATE = 'late';
    case REVIEWED = 'reviewed';
    case RESUBMIT_REQUIRED = 'resubmit_required';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Brouillon',
            self::SUBMITTED => 'Soumis',
            self::LATE => 'Soumis en retard',
            self::REVIEWED => 'Évalué',
            self::RESUBMIT_REQUIRED => 'Nouvelle soumission requise',
            self::ACCEPTED => 'Accepté',
            self::REJECTED => 'Rejeté',
        };
    }

    public function isSubmittedState(): bool
    {
        return in_array($this, [
            self::SUBMITTED,
            self::LATE,
            self::REVIEWED,
            self::RESUBMIT_REQUIRED,
            self::ACCEPTED,
            self::REJECTED,
        ], true);
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
