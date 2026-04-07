<?php

namespace App\Domain\Programs\Enums;

enum DurationUnit: string
{
   case DAY   = 'day';
   case WEEK  = 'week';
   case MONTH = 'month';
}
