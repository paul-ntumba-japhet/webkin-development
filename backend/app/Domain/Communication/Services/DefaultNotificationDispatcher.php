<?php

namespace App\Infrastructure\Notifications\Services;

use App\Domain\Communication\Services\NotificationDispatcherInterface;
use App\Models\Notification;

final class DefaultNotificationDispatcher implements NotificationDispatcherInterface
{
    /*** *
    public function __construct(
        private readonly NotificationChannelRegistry $registry,
    ) {
    }

    public function dispatch(Notification $notification, array $channels = []): void
    {
        $channels = $channels === [] ? ['in_app'] : $channels;

        foreach ($channels as $channelCode) {
            $this->registry->get($channelCode)->send($notification);
        }
    }
        ***/

    public function dispatch(Notification $notification, array $channels = []): void
    {
        throw new \Exception('Not implemented');
    }
}
