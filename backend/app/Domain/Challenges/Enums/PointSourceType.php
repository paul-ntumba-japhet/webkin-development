<?php

namespace App\Domain\Challenge\Enums;

enum PointSourceType: string
{
    case CHALLENGE = 'challenge';
    case ASSIGNMENT = 'assignment';
    case BONUS = 'bonus';
    case MANUAL = 'manual';
}
