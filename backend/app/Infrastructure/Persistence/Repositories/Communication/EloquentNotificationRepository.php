<?php

namespace App\Infrastructure\Persistence\Repositories\Communication;

use App\Domain\Communication\Repositories\NotificationRepositoryInterface;
use App\Models\Notification;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentNotificationRepository implements NotificationRepositoryInterface
{
    public function listForUser(int $userId, int $perPage = 20): LengthAwarePaginator
    {
        return Notification::query()->where('user_id', $userId)->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): Notification
    {
        return Notification::query()->create($attributes);
    }
    public function markAsRead(Notification $notification): Notification
    {
        $notification->update(['read_at' => now()]);

        return $notification->refresh();
    }
    public function markAllAsRead(int $userId): void
    {
        Notification::query()->where('user_id', $userId)->whereNull('read_at')->update(['read_at' => now()]);
    }
}
