<?php

namespace App\Domain\Mentoring\Enums;

enum MentorshipMode: string
{
    case ONLINE = 'online';
    case ONSITE = 'onsite';

    public function label(): string
    {
        return match($this) {
            self::ONLINE => 'Online',
            self::ONSITE => 'Onsite',
        };
    }

    public static function values(): array
    {
        return array_map(fn($mode) => $mode->value, self::cases());
    }
}
