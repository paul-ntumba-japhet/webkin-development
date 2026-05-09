<?php

namespace App\Application\Programs\DTOs;

use App\Domain\Shared\Enums\DifficultyLevel;
use Illuminate\Http\Request;

final readonly class UpdateProgramOutcomeProjectData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $stackSummary,
        public DifficultyLevel $difficultyLevel,
        public string $status,
        public int $position,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            stackSummary: $request->input('stack_summary'),
            difficultyLevel: DifficultyLevel::from($request->input('difficulty_level')),
            status: $request->string('status')->toString(),
            position: (int) $request->input('position', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'stack_summary' => $this->stackSummary,
            'difficulty_level' => $this->difficultyLevel->value,
            'status' => $this->status,
            'position' => $this->position,
        ];
    }
}
