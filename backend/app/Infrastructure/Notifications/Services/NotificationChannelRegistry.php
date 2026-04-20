<?php

namespace App\Infrastructure\Notifications\Services;

use App\Infrastructure\Notifications\Contracts\NotificationChannelInterface;
use InvalidArgumentException;

final class NotificationChannelRegistry
{
    /** @var array<string, NotificationChannelInterface> */
    private array $channels = [];

    public function __construct(iterable $channels)
    {
        foreach ($channels as $channel) {
            $this->channels[$channel->code()] = $channel;
        }
    }

    public function get(string $code): NotificationChannelInterface
    {
        return $this->channels[$code]
            ?? throw new InvalidArgumentException("Aucun canal enregistré pour [$code].");
    }

    public function all(): array
    {
        return array_values($this->channels);
    }
}
