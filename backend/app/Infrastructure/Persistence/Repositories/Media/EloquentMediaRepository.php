<?php

namespace App\Infrastructure\Persistence\Repositories\Media;

use App\Domain\Media\Repositories\MediaRepositoryInterface;
use App\Models\Media;
use Illuminate\Support\Collection;


final class EloquentMediaRepository implements MediaRepositoryInterface
{
    public function findById(int $id): ?Media
    {
        return Media::query()->find($id);
    }
    public function listByOwner(string $ownerType, int $ownerId): Collection
    {
        return Media::query()->where('owner_type', $ownerType)->where('owner_id', $ownerId)->latest('id')->get();
    }
    public function create(array $attributes): Media
    {
        return Media::query()->create($attributes);
    }
    public function update(Media $media, array $attributes): Media
    {
        $media->update($attributes);

        return $media->refresh();
    }
    public function delete(Media $media): bool
    {
        return $media->delete();
    }
}
