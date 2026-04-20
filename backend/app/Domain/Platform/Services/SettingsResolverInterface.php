<?php

namespace App\Domain\Platform\Services;



interface SettingsResolverInterface
{
    public function get(string $key, mixed $default = null): mixed;
}


