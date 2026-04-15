<?php

namespace App\Infrastructure\Persistence\Repositories\Platform;

use App\Domain\Platform\Repositories\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Collection;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentSettingRepository implements SettingRepositoryInterface
{
    public function getByKey(string $key): ?Setting
    {
        return Setting::query()->where('key', $key)->first();
    }
    public function set(string $key, mixed $value): Setting
    {
        return Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    }
    public function allPublic(): Collection
    {
        return Setting::query()->where('is_public', true)->orderBy('key')->get();
    }
}
