<?php

namespace App\Infrastructure\Persistence\Repositories\Cohorts;

use App\Domain\Cohorts\Repositories\RoomRepositoryInterface;
use App\Models\Room;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentRoomRepository implements RoomRepositoryInterface
{
    public function findById(int $id): ?Room
    {
        return Room::query()->find($id);
    }
    public function allAvailable(): Collection
    {
        return Room::query()->where('is_active', true)->orderBy('name')->get();
    }
    public function create(array $attributes): Room
    {
        return Room::query()->create($attributes);
    }
    public function update(Room $room, array $attributes): Room
    {
        $room->update($attributes);

        return $room->refresh();
    }
    public function delete(Room $room): bool
    {
        return $room->delete();
    }
}
