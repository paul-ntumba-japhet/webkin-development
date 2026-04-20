<?php

namespace App\Domain\Platform\Services;

use App\Domain\Platform\Services\SettingsResolverInterface;
use App\Domain\Platform\Repositories\SettingRepositoryInterface;

final class CachedSettingsResolver implements SettingsResolverInterface
{
    public function __construct(
        private readonly SettingRepositoryInterface $settings,
    ) {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $setting = $this->settings->getByKey($key);

        return $setting?->value ?? $default;
    }
}
