<?php

namespace App\Infrastructure\Storage\Contracts;

use Illuminate\Http\UploadedFile;

interface MediaStorageInterface
{
    public function code(): string;

    public function putFile(UploadedFile $file, string $path, array $options = []): string;

    public function delete(string $path): bool;

    public function url(string $path): string;
}
