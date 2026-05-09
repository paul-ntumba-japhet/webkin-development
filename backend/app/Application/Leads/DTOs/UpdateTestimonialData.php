<?php

namespace App\Application\Leads\DTOs;

use App\Domain\Media\Enums\TestimonialStatus;
use Illuminate\Http\Request;

final readonly class UpdateTestimonialData
{
    public function __construct(
        public string $name,
        public ?string $roleLabel,
        public string $content,
        public ?string $videoUrl,
        public ?int $avatarMediaId,
        public ?int $rating,
        public bool $isFeatured,
        public TestimonialStatus $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            roleLabel: $request->filled('role_label') ? $request->string('role_label')->toString() : null,
            content: $request->string('content')->toString(),
            videoUrl: $request->filled('video_url') ? $request->string('video_url')->toString() : null,
            avatarMediaId: $request->filled('avatar_media_id') ? (int) $request->input('avatar_media_id') : null,
            rating: $request->filled('rating') ? (int) $request->input('rating') : null,
            isFeatured: $request->boolean('is_featured'),
            status: TestimonialStatus::from($request->input('status')),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role_label' => $this->roleLabel,
            'content' => $this->content,
            'video_url' => $this->videoUrl,
            'avatar_media_id' => $this->avatarMediaId,
            'rating' => $this->rating,
            'is_featured' => $this->isFeatured,
            'status' => $this->status->value,
        ];
    }
}
