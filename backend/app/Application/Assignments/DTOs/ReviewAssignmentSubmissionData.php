<?php

namespace App\Application\Assignments\DTOs;

use App\Domain\Assignments\Enums\AssignmentSubmissionStatus;
use Illuminate\Http\Request;

final readonly class ReviewAssignmentSubmissionData
{
    public function __construct(
        public int $reviewerId,
        public string $score,
        public ?string $feedback,
        public ?string $reviewedAt,
        public AssignmentSubmissionStatus $submissionStatus,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reviewerId: (int) $request->input('reviewer_id'),
            score: number_format((float) $request->input('score', 0), 2, '.', ''),
            feedback: $request->filled('feedback') ? $request->string('feedback')->toString() : null,
            reviewedAt: $request->date('reviewed_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            submissionStatus: AssignmentSubmissionStatus::from($request->input('submission_status', AssignmentSubmissionStatus::REVIEWED->value)),
        );
    }

    public function toArray(): array
    {
        return [
            'review' => [
                'reviewer_id' => $this->reviewerId,
                'score' => $this->score,
                'feedback' => $this->feedback,
                'reviewed_at' => $this->reviewedAt,
            ],
            'submission' => [
                'status' => $this->submissionStatus->value,
            ],
        ];
    }
}
