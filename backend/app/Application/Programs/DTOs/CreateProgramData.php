<?php

namespace App\Application\Programs\DTOs;

use App\Domain\Programs\Enums\DurationUnit;
use App\Domain\Programs\Enums\ProgramStatus;
use Illuminate\Http\Request;

final readonly class CreateProgramData
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $shortDescription,
        public ?string $longDescription,
        public ?string $curriculumSummary,
        public int $durationValue,
        public DurationUnit $durationUnit,
        public ?string $professionalOutcomes,
        public ProgramStatus $status,
        public bool $isFeatured = false,
        public ?int $coverMediaId = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            slug: $request->string('slug')->toString(),
            shortDescription: $request->string('short_description')->toString(),
            longDescription: $request->input('long_description'),
            curriculumSummary: $request->input('curriculum_summary'),
            durationValue: (int) $request->input('duration_value'),
            durationUnit: DurationUnit::from($request->input('duration_unit')),
            professionalOutcomes: $request->input('professional_outcomes'),
            status: ProgramStatus::from($request->input('status')),
            isFeatured: $request->boolean('is_featured'),
            coverMediaId: $request->filled('cover_media_id')
                ? (int) $request->input('cover_media_id')
                : null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->shortDescription,
            'long_description' => $this->longDescription,
            'curriculum_summary' => $this->curriculumSummary,
            'duration_value' => $this->durationValue,
            'duration_unit' => $this->durationUnit->value,
            'professional_outcomes' => $this->professionalOutcomes,
            'status' => $this->status->value,
            'is_featured' => $this->isFeatured,
            'cover_media_id' => $this->coverMediaId,
        ];
    }
}
