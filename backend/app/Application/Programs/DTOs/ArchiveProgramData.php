<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class ArchiveProgramData
{
    public function __construct(
        public ?string $reason = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reason: $request->input('reason'),
        );
    }
}
