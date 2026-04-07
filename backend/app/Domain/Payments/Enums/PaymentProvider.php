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
}
