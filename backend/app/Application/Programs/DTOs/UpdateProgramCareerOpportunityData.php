<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class UpdateProgramCareerOpportunityData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public int $position,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            position: (int) $request->input('position', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'position' => $this->position,
        ];
    }
}
