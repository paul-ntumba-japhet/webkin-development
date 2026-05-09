<?php

namespace App\Application\Media\DTOs;

use App\Domain\Media\Enums\MediaType;
use Illuminate\Http\Request;

final readonly class UpdateMediaMetadataData
{
    public function __construct(
        public string $filename,
        public string $originalName,
        public string $mimeType,
        public ?string $extension,
        public int $size,
        public string $disk,
        public string $path,
        public ?string $url,
        public MediaType $type,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            filename: $request->string('filename')->toString(),
            originalName: $request->string('original_name')->toString(),
            mimeType: $request->string('mime_type')->toString(),
            extension: $request->filled('extension') ? $request->string('extension')->toString() : null,
            size: (int) $request->input('size', 0),
            disk: $request->string('disk')->toString(),
            path: $request->string('path')->toString(),
            url: $request->filled('url') ? $request->string('url')->toString() : null,
            type: MediaType::from($request->input('type')),
        );
    }

    public function toArray(): array
    {
        return [
            'filename' => $this->filename,
            'original_name' => $this->originalName,
            'mime_type' => $this->mimeType,
            'extension' => $this->extension,
            'size' => $this->size,
            'disk' => $this->disk,
            'path' => $this->path,
            'url' => $this->url,
            'type' => $this->type->value,
        ];
    }
}
