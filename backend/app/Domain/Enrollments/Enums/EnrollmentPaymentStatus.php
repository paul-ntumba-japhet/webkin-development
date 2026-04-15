<?php

namespace App\Domain\Enrollments\Enums;

enum EnrollmentPaymentStatus: string
{
    case UNPAID = 'unpaid';
    case PARTIAL = 'partial';
    case PAID = 'paid';
    case OVERDUE = 'overdue';

    public function label() : string
    {
        return match ($this){
            self::UNPAID => 'Non payé',
            self::PARTIAL => 'Partiellement payé',
            self::PAID => 'Payé',
            self::OVERDUE => 'En retard',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
