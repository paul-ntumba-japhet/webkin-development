<?php

namespace App\Application\Assignments\DTOs;

use Illuminate\Http\Request;

final readonly class UpdateAssignmentReviewData
{
    public function __construct(
        public string $score,
        public ?string $feedback,
        public ?string $reviewedAt,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            score: number_format((float) $request->input('score', 0), 2, '.', ''),
            feedback: $request->filled('feedback') ? $request->string('feedback')->toString() : null,
            reviewedAt: $request->date('reviewed_at')?->toDateTimeString() ?? now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'score' => $this->score,
            'feedback' => $this->feedback,
            'reviewed_at' => $this->reviewedAt,
        ];
    }
}
