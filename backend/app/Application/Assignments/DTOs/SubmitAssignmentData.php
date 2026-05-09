<?php

namespace App\Application\Assignments\DTOs;

use App\Domain\Assignments\Enums\AssignmentSubmissionStatus;
use Illuminate\Http\Request;

final readonly class SubmitAssignmentData
{
    public function __construct(
        public int $assignmentId,
        public int $studentId,
        public ?string $submissionText,
        public ?string $repositoryUrl,
        public ?int $fileMediaId,
        public ?string $submittedAt,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            assignmentId: (int) $request->input('assignment_id'),
            studentId: (int) $request->input('student_id'),
            submissionText: $request->filled('submission_text') ? $request->string('submission_text')->toString() : null,
            repositoryUrl: $request->filled('repository_url') ? $request->string('repository_url')->toString() : null,
            fileMediaId: $request->filled('file_media_id') ? (int) $request->input('file_media_id') : null,
            submittedAt: $request->date('submitted_at')?->toDateTimeString() ?? now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'assignment_id' => $this->assignmentId,
            'student_id' => $this->studentId,
            'submission_text' => $this->submissionText,
            'repository_url' => $this->repositoryUrl,
            'file_media_id' => $this->fileMediaId,
            'submitted_at' => $this->submittedAt,
            'status' => AssignmentSubmissionStatus::SUBMITTED->value,
        ];
    }
}
