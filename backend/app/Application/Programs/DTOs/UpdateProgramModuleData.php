<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class UpdateProgramModuleData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public int $position,
        public bool $isPublished,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            position: (int) $request->input('position', 0),
            isPublished: $request->boolean('is_published'),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'position' => $this->position,
            'is_published' => $this->isPublished,
        ];
    }
}
