<?php

namespace App\Application\Billing\DTOs;

use Illuminate\Http\Request;

final readonly class VoidInvoiceData
{
    public function __construct(
        public ?string $reason = null,
        public bool $clearFilePath = false,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reason: $request->filled('reason') ? $request->string('reason')->toString() : null,
            clearFilePath: $request->boolean('clear_file_path'),
        );
    }

    public function toArray(): array
    {
        if (! $this->clearFilePath) {
            return [];
        }

        return ['file_path' => null];
    }
}
