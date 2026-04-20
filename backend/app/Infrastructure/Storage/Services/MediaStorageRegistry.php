<?php

namespace App\Infrastructure\Storage\Services;

use App\Infrastructure\Storage\Contracts\MediaStorageInterface;
use InvalidArgumentException;

final class MediaStorageRegistry
{
    /** @var array<string, MediaStorageInterface> */
    private array $drivers = [];

    public function __construct(iterable $drivers)
    {
        foreach ($drivers as $driver) {
            $this->drivers[$driver->code()] = $driver;
        }
    }

    public function get(string $code): MediaStorageInterface
    {
        return $this->drivers[$code]
            ?? throw new InvalidArgumentException("Aucun driver de stockage enregistré pour [$code].");
    }
}
