<?php

namespace App\Application\Challenges\DTOs;

use App\Domain\Challenges\Enums\ChallengeCategory;
use App\Domain\Challenges\Enums\ChallengeStatus;
use App\Domain\Curriculum\Enums\DifficultyLevel;
use Illuminate\Http\Request;

final readonly class CreateChallengeData
{
    public function __construct(
        public string $title,
        public string $slug,
        public ?string $description,
        public DifficultyLevel $difficulty,
        public ChallengeCategory $category,
        public ?string $instructions,
        public ?string $starterCodeUrl,
        public ?string $solutionUrl,
        public int $maxPoints,
        public ChallengeStatus $status,
        public ?string $publishedAt,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            slug: $request->string('slug')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            difficulty: DifficultyLevel::from($request->input('difficulty')),
            category: ChallengeCategory::from($request->input('category')),
            instructions: $request->filled('instructions') ? $request->string('instructions')->toString() : null,
            starterCodeUrl: $request->filled('starter_code_url') ? $request->string('starter_code_url')->toString() : null,
            solutionUrl: $request->filled('solution_url') ? $request->string('solution_url')->toString() : null,
            maxPoints: (int) $request->input('max_points', 0),
            status: ChallengeStatus::from($request->input('status', ChallengeStatus::DRAFT->value)),
            publishedAt: $request->date('published_at')?->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'difficulty' => $this->difficulty->value,
            'category' => $this->category->value,
            'instructions' => $this->instructions,
            'starter_code_url' => $this->starterCodeUrl,
            'solution_url' => $this->solutionUrl,
            'max_points' => $this->maxPoints,
            'status' => $this->status->value,
            'published_at' => $this->publishedAt,
        ];
    }
}
