<?php

namespace App\Domain\Platform\Enums;

enum SettingType: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case JSON = 'json';
}

