<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class CreateProgramCareerOpportunityData
{
    public function __construct(
        public int $programId,
        public string $title,
        public ?string $description,
        public int $position = 0,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            programId: (int) $request->input('program_id'),
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            position: (int) $request->input('position', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'program_id' => $this->programId,
            'title' => $this->title,
            'description' => $this->description,
            'position' => $this->position,
        ];
    }
}
