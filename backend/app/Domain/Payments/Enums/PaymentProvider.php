<?php

namespace App\Domain\Payments\Enums;

enum PaymentProvider: string
{
    case STRIPE = 'stripe';
    case ORANGE_MONEY = 'orange_money';
    case AIRTEL_MONEY = 'airtel_money';
    case M_PESA = 'm_pesa';
    case CASH_DESK = 'cash_desk';
    case BANK = 'bank';

    public function label(): string
    {
        return match($this) {
            self::STRIPE => 'Stripe',
            self::ORANGE_MONEY => 'Orange Money',
            self::AIRTEL_MONEY => 'Airtel Money',
            self::M_PESA => 'M-Pesa',
            self::CASH_DESK => 'Cash Desk',
            self::BANK => 'Bank',
        };
    }

    public static function values(): array
    {
        return array_map(fn($provider) => $provider->value, self::cases());
    }

}
