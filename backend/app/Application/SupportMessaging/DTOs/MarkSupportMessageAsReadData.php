<?php

namespace App\Application\SupportMessaging\DTOs;

use Illuminate\Http\Request;

final readonly class MarkSupportMessageAsReadData
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
