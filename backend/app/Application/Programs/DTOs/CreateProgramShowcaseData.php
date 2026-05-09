<?php

namespace App\Application\Programs\DTOs;

use App\Domain\Programs\Enums\ProgramShowcaseType;
use App\Domain\Programs\Enums\ProgramShowcaseStatus;
use Illuminate\Http\Request;

final readonly class CreateProgramShowcaseData
{
    public function __construct(
        public int $programId,
        public string $title,
        public ?string $description,
        public ProgramShowcaseType $type,
        public ProgramShowcaseStatus $status,
        public ?string $url,
        public ?int $mediaId,
        public int $position = 0,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            programId: (int) $request->input('program_id'),
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            type: ProgramShowcaseType::from($request->input('type')),
            status: ProgramShowcaseStatus::from($request->input('status')),
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
            'program_id' => $this->programId,
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
