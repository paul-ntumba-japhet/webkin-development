<?php

namespace App\Infrastructure\Notifications\Channels;

use App\Infrastructure\Notifications\Contracts\NotificationChannelInterface;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

final class MailNotificationChannel implements NotificationChannelInterface
{
    public function code(): string
    {
        return 'mail';
    }

    public function send(Notification $notification): void
    {
        if (! $notification->user?->email) {
            return;
        }

        Mail::raw((string) ($notification->body ?? ''), function ($message) use ($notification) {
            $message
                ->to($notification->user->email)
                ->subject((string) ($notification->title ?? 'Notification'));
        });
    }
}
