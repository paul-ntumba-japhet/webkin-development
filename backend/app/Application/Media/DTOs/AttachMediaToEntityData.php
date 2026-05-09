<?php

namespace App\Application\Media\DTOs;

use Illuminate\Http\Request;

final readonly class AttachMediaToEntityData
{
    public function __construct(
        public int $mediaId,
        public string $entityType,
        public int $entityId,
        public ?string $field = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            mediaId: (int) $request->input('media_id'),
            entityType: $request->string('entity_type')->toString(),
            entityId: (int) $request->input('entity_id'),
            field: $request->filled('field') ? $request->string('field')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'media_id' => $this->mediaId,
            'entity_type' => $this->entityType,
            'entity_id' => $this->entityId,
            'field' => $this->field,
        ];
    }
}
