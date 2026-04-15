<?php


namespace App\Domain\Communication\Repositories;

use App\Models\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NotificationRepositoryInterface
{
    public function listForUser(int $userId, int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): Notification;
    public function markAsRead(Notification $notification): Notification;
    public function markAllAsRead(int $userId): void;
}
