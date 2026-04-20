<?php

namespace App\Infrastructure\Notifications\Contracts;

use App\Models\Notification;

interface NotificationChannelInterface
{
    public function code(): string;

    public function send(Notification $notification): void;
}

