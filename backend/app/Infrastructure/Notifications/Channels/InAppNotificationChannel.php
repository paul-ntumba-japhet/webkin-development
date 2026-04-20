<?php

namespace App\Infrastructure\Notifications\Channels;

use App\Infrastructure\Notifications\Contracts\NotificationChannelInterface;
use App\Models\Notification;

final class InAppNotificationChannel implements NotificationChannelInterface
{
    public function code(): string
    {
        return 'in_app';
    }

    public function send(Notification $notification): void
    {
        // Les notifications in-app sont déjà stockées dans la base de données,
        // donc aucune action supplémentaire n'est nécessaire pour les envoyer.
    }
}
