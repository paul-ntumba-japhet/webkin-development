<?php

namespace App\Infrastructure\Storage\Services;

use App\Infrastructure\Storage\Contracts\MediaStorageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class LocalMediaStorage implements MediaStorageInterface
{
    public function __construct(
        private readonly string $disk = 'public',
    ) {
    }

    public function code(): string
    {
        return 'local';
    }

    public function putFile(UploadedFile $file, string $path, array $options = []): string
    {
        return Storage::disk($this->disk)->putFileAs(
            dirname($path),
            $file,
            basename($path),
            $options
        );
    }

    public function delete(string $path): bool
    {
        return Storage::disk($this->disk)->delete($path);
    }

    public function url(string $path): string
    {
        //return Storage::disk($this->disk)->url($path);
        return "";
    }
}
