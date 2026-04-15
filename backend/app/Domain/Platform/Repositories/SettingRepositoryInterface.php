<?php

namespace App\Domain\Platform\Repositories;

use App\Models\Setting;
use Illuminate\Support\Collection;

interface SettingRepositoryInterface
{
    public function getByKey(string $key): ?Setting;
    public function set(string $key, mixed $value): Setting;
    public function allPublic(): Collection;
}
