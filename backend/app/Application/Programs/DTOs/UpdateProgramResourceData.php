<?php

namespace App\Application\Programs\DTOs;

use App\Domain\Programs\Enums\ProgramResourceType;
use App\Domain\Programs\Enums\ProgramResourceStatus;
use Illuminate\Http\Request;

final readonly class UpdateProgramResourceData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ProgramResourceType $type,
        public ProgramResourceStatus $status,
        public ?string $url,
        public ?int $mediaId,
        public int $position,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            type: ProgramResourceType::from($request->input('type')),
            status: ProgramResourceStatus::from($request->input('status')),
            url: $request->input('url'),
            mediaId: $request->filled('media_id')
                ? (int) $request->input('media_id')
                : null,
            position: (int) $request->input('position', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type->value,
            'status' => $this->status->value,
            'url' => $this->url,
            'media_id' => $this->mediaId,
            'position' => $this->position,
        ];
    }
}
