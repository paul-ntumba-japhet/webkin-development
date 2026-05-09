<?php

namespace App\Application\Projects\DTOs;

use App\Domain\Projects\Enums\StudentProjectStatus;
use Illuminate\Http\Request;

final readonly class UpdateStudentProjectData
{
    public function __construct(
        public string $title,
        public string $slug,
        public ?string $description,
        public ?string $stackSummary,
        public ?string $githubUrl,
        public ?string $demoUrl,
        public ?int $coverMediaId,
        public StudentProjectStatus $status,
        public bool $isFeatured,
        public ?string $publishedAt,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            slug: $request->string('slug')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            stackSummary: $request->filled('stack_summary') ? $request->string('stack_summary')->toString() : null,
            githubUrl: $request->filled('github_url') ? $request->string('github_url')->toString() : null,
            demoUrl: $request->filled('demo_url') ? $request->string('demo_url')->toString() : null,
            coverMediaId: $request->filled('cover_media_id') ? (int) $request->input('cover_media_id') : null,
            status: StudentProjectStatus::from($request->input('status')),
            isFeatured: $request->boolean('is_featured'),
            publishedAt: $request->date('published_at')?->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'stack_summary' => $this->stackSummary,
            'github_url' => $this->githubUrl,
            'demo_url' => $this->demoUrl,
            'cover_media_id' => $this->coverMediaId,
            'status' => $this->status->value,
            'is_featured' => $this->isFeatured,
            'published_at' => $this->publishedAt,
        ];
    }
}
