<?php

namespace App\Application\Challenges\DTOs;

use App\Domain\Challenges\Enums\ChallengeSubmissionStatus;
use Illuminate\Http\Request;

final readonly class SubmitChallengeData
{
    public function __construct(
        public int $challengeId,
        public int $studentId,
        public ?string $repositoryUrl,
        public ?string $liveUrl,
        public ?string $submissionText,
        public ?string $submittedAt,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            challengeId: (int) $request->input('challenge_id'),
            studentId: (int) $request->input('student_id'),
            repositoryUrl: $request->filled('repository_url') ? $request->string('repository_url')->toString() : null,
            liveUrl: $request->filled('live_url') ? $request->string('live_url')->toString() : null,
            submissionText: $request->filled('submission_text') ? $request->string('submission_text')->toString() : null,
            submittedAt: $request->date('submitted_at')?->toDateTimeString() ?? now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'challenge_id' => $this->challengeId,
            'student_id' => $this->studentId,
            'repository_url' => $this->repositoryUrl,
            'live_url' => $this->liveUrl,
            'submission_text' => $this->submissionText,
            'submitted_at' => $this->submittedAt,
            'status' => ChallengeSubmissionStatus::SUBMITTED->value,
        ];
    }
}
