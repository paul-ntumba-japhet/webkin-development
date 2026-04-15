<?php

namespace App\Domain\Payments\Enums;

enum PaymentMethod: string
{
    case BANK_CARD = 'bank_card';
    case MOBILE_MONEY = 'mobile_money';
    case CASH = 'cash';
    case BANK_TRANSFER = 'bank_transfer';

    public function label(): string
    {
        return match($this) {
            self::BANK_CARD => 'Bank Card',
            self::MOBILE_MONEY => 'Mobile Money',
            self::CASH => 'Cash',
            self::BANK_TRANSFER => 'Bank Transfer',
        };
    }

    public static function values(): array
    {
        return array_map(fn($method) => $method->value, self::cases());
    }
}
