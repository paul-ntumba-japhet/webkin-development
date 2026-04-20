<?php


namespace App\Domain\Media\Services;

interface MediaPathGeneratorInterface
{
    public function generate(string $disk, string $directory, string $filename): string;
}
