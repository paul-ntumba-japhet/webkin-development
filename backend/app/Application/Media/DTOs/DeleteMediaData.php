<?php

namespace App\Application\Media\DTOs;

use Illuminate\Http\Request;

final readonly class DeleteMediaData
{
    public function __construct(
        public bool $force = false,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            force: $request->boolean('force'),
        );
    }

    public function toArray(): array
    {
        return ['force' => $this->force];
    }
}
