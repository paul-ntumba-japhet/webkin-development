<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class PublishProgramData
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
}

