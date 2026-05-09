<?php

namespace App\Application\Curriculum\DTOs;

use Illuminate\Http\Request;

final readonly class UpdateStudentProgressData
{
    public function __construct(
        public int $progressPercent,
        public ?string $lastAccessedAt = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            progressPercent: max(0, min(100, (int) $request->input('progress_percent', 0))),
            lastAccessedAt: $request->date('last_accessed_at')?->toDateTimeString() ?? now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'progress_percent' => $this->progressPercent,
            'last_accessed_at' => $this->lastAccessedAt,
            'completed_at' => $this->progressPercent >= 100 ? now()->toDateTimeString() : null,
        ];
    }
}
