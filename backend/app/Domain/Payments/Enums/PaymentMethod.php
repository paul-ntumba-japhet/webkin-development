<?php

namespace App\Domain\Payments\Enums;

enum PaymentMethod: string
{
    case BANK_CARD = 'bank_card';
    case MOBILE_MONEY = 'mobile_money';
    case CASH = 'cash';
    case BANK_TRANSFER = 'bank_transfer';
}
