<?php

namespace App\Application\Communication\DTOs;

use Illuminate\Http\Request;

final readonly class MarkNotificationAsReadData
{
    public function __construct(
        public ?string $readAt = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            readAt: $request->date('read_at')?->toDateTimeString() ?? now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return ['read_at' => $this->readAt];
    }
}
