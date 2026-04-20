<?php

namespace App\Domain\Media\Services;

use App\Domain\Media\Services\MediaPathGeneratorInterface;
use Illuminate\Support\Str;

final class DefaultMediaPathGenerator implements MediaPathGeneratorInterface
{
    public function generate(string $disk, string $directory, string $filename): string
    {
        $datePrefix = now()->format('Y/m');
        $cleanName = Str::slug(pathinfo($filename, PATHINFO_FILENAME));
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return trim($directory, '/') . '/' . $datePrefix . '/' . $cleanName . '-' . Str::lower(Str::random(8)) . '.' . $extension;
    }
}
