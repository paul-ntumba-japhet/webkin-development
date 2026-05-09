<?php

namespace App\Application\Platform\DTOs;

use Illuminate\Http\Request;

final readonly class BulkUpdateSettingsData
{
    /**
     * @param array<int, array<string, mixed>> $items
     */
    public function __construct(
        public array $items,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            items: array_values((array) $request->input('items', [])),
        );
    }

    public function toArray(): array
    {
        return ['items' => $this->items];
    }
}
