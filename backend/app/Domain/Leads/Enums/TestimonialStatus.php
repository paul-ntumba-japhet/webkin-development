<?php

namespace App\Domain\Media\Enums;

enum TestimonialStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::APPROVED => 'Approuvé',
            self::REJECTED => 'Rejeté',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
