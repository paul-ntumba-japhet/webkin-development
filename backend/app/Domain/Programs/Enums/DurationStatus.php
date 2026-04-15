<?php

namespace App\Domain\Programs\Enums;

enum DurationUnit: string
{
   case DAY   = 'day';
   case WEEK  = 'week';
   case MONTH = 'month';

    public function label(): string
    {
         return match($this) {
              self::DAY => 'Jour',
              self::WEEK => 'Semaine',
              self::MONTH => 'Mois',
         };
    }

    public static function values(): array
    {
        return array_map(fn($unit) => $unit->value, self::cases());
    }
}
