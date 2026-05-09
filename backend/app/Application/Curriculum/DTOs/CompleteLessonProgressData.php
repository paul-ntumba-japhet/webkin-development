<?php

namespace App\Application\Curriculum\DTOs;

use Illuminate\Http\Request;

final readonly class CompleteLessonProgressData
{
    public function __construct(
        public ?string $completedAt = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            completedAt: $request->date('completed_at')?->toDateTimeString() ?? now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'progress_percent' => 100,
            'completed_at' => $this->completedAt,
            'last_accessed_at' => $this->completedAt,
        ];
    }
}
