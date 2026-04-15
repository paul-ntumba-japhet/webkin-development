<?php

namespace App\Domain\Cohorts\Repositories;

use App\Models\Room;
use Illuminate\Support\Collection;

interface RoomRepositoryInterface
{
    public function findById(int $id): ?Room;
    public function allAvailable(): Collection;
    public function create(array $attributes): Room;
    public function update(Room $room, array $attributes): Room;
    public function delete(Room $room): bool;
}


