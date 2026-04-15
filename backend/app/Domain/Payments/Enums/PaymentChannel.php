<?php

namespace App\Domain\Payments\Enums;

enum PaymentChannel: string
{
    case WEB = 'web';
    case MOBILE_APP = 'mobile_app';
    case BACK_OFFICE = 'back_office';
    case POS = 'pos';

    public function label(): string
    {
        return match($this) {
            self::WEB => 'Web',
            self::MOBILE_APP => 'Mobile App',
            self::BACK_OFFICE => 'Back Office',
            self::POS => 'Point de vente (POS)',
        };
    }

    public static function values(): array
    {
        return array_map(fn($channel) => $channel->value, self::cases());
    }
}
