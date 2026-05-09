<?php

namespace App\Application\Challenges\DTOs;

use App\Domain\Challenges\Enums\ChallengeSubmissionStatus;
use Illuminate\Http\Request;

final readonly class ReviewChallengeSubmissionData
{
    public function __construct(
        public int $reviewedByUserId,
        public ?int $score,
        public ?string $feedback,
        public ?string $reviewedAt,
        public ChallengeSubmissionStatus $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reviewedByUserId: (int) $request->input('reviewed_by_user_id'),
            score: $request->filled('score') ? (int) $request->input('score') : null,
            feedback: $request->filled('feedback') ? $request->string('feedback')->toString() : null,
            reviewedAt: $request->date('reviewed_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            status: ChallengeSubmissionStatus::from($request->input('status', ChallengeSubmissionStatus::REVIEWED->value)),
        );
    }

    public function toArray(): array
    {
        return [
            'reviewed_by_user_id' => $this->reviewedByUserId,
            'score' => $this->score,
            'feedback' => $this->feedback,
            'reviewed_at' => $this->reviewedAt,
            'status' => $this->status->value,
        ];
    }
}
