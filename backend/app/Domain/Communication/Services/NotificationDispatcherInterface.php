<?php

namespace App\Domain\Communication\Services;

use App\Models\Notification;

interface NotificationDispatcherInterface
{
    public function dispatch(Notification $notification, array $channels = []): void;
}


