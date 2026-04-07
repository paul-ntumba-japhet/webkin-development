<?php

namespace App\Domain\Payments\Enums;

enum PaymentChannel: string
{
    case WEB = 'web';
    case MOBILE_APP = 'mobile_app';
    case BACK_OFFICE = 'back_office';
    case POS = 'pos';
}
