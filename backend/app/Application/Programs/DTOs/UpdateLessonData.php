<?php

namespace App\Application\Programs\DTOs;

use App\Domain\Programs\Enums\LessonType;
use Illuminate\Http\Request;

final readonly class UpdateLessonData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public LessonType $type,
        public ?string $content,
        public ?string $videoUrl,
        public ?int $durationMinutes,
        public int $position,
        public bool $isPreview,
        public bool $isPublished,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->string('title')->toString(),
            description: $request->input('description'),
            type: LessonType::from($request->input('type')),
            content: $request->input('content'),
            videoUrl: $request->input('video_url'),
            durationMinutes: $request->filled('duration_minutes')
                ? (int) $request->input('duration_minutes')
                : null,
            position: (int) $request->input('position', 0),
            isPreview: $request->boolean('is_preview'),
            isPublished: $request->boolean('is_published'),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type->value,
            'content' => $this->content,
            'video_url' => $this->videoUrl,
            'duration_minutes' => $this->durationMinutes,
            'position' => $this->position,
            'is_preview' => $this->isPreview,
            'is_published' => $this->isPublished,
        ];
    }
}
