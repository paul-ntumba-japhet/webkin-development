<?php

namespace App\Domain\Enrollments\Enums;

enum BillingPeriodStatus: string
{
    case PENDING = 'pending';
    case PARTIAL = 'partial';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::PARTIAL => 'Partiel',
            self::PAID => 'Payé',
            self::OVERDUE => 'En retard',
            self::CANCELLED => 'Annulé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
