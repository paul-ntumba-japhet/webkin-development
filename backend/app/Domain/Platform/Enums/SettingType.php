<?php

namespace App\Domain\Platform\Enums;

enum SettingType: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case JSON = 'json';

    public function label(): string
    {
        return match($this) {
            self::STRING => 'String',
            self::INTEGER => 'Integer',
            self::BOOLEAN => 'Boolean',
            self::JSON => 'JSON',
        };
    }

    public static function values(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }
}

