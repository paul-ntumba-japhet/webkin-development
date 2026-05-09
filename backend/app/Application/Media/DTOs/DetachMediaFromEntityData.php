<?php

namespace App\Application\Media\DTOs;

use Illuminate\Http\Request;

final readonly class DetachMediaFromEntityData
{
    public function __construct(
        public string $entityType,
        public int $entityId,
        public ?string $field = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            entityType: $request->string('entity_type')->toString(),
            entityId: (int) $request->input('entity_id'),
            field: $request->filled('field') ? $request->string('field')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'entity_type' => $this->entityType,
            'entity_id' => $this->entityId,
            'field' => $this->field,
        ];
    }
}
