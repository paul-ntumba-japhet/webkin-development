<?php

namespace App\Application\Projects\DTOs;

use App\Domain\Projects\Enums\StudentProjectStatus;
use Illuminate\Http\Request;

final readonly class CreateStudentProjectData
{
    public function __construct(
        public int $studentId,
        public int $programId,
        public int $cohortId,
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
            studentId: (int) $request->input('student_id'),
            programId: (int) $request->input('program_id'),
            cohortId: (int) $request->input('cohort_id'),
            title: $request->string('title')->toString(),
            slug: $request->string('slug')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            stackSummary: $request->filled('stack_summary') ? $request->string('stack_summary')->toString() : null,
            githubUrl: $request->filled('github_url') ? $request->string('github_url')->toString() : null,
            demoUrl: $request->filled('demo_url') ? $request->string('demo_url')->toString() : null,
            coverMediaId: $request->filled('cover_media_id') ? (int) $request->input('cover_media_id') : null,
            status: StudentProjectStatus::from($request->input('status', StudentProjectStatus::DRAFT->value)),
            isFeatured: $request->boolean('is_featured'),
            publishedAt: $request->date('published_at')?->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->studentId,
            'program_id' => $this->programId,
            'cohort_id' => $this->cohortId,
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
