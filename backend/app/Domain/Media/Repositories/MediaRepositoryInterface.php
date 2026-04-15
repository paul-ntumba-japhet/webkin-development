<?php

namespace App\Domain\Media\Repositories;

use App\Models\Media;
use Illuminate\Support\Collection;

interface MediaRepositoryInterface
{
    public function findById(int $id): ?Media;
    public function listByOwner(string $ownerType, int $ownerId): Collection;
    public function create(array $attributes): Media;
    public function update(Media $media, array $attributes): Media;
    public function delete(Media $media): bool;
}


