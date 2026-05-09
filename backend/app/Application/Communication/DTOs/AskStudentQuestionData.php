<?php

namespace App\Application\Communication\DTOs;

use App\Domain\Communication\Enums\StudentQuestionStatus;
use Illuminate\Http\Request;

final readonly class AskStudentQuestionData
{
    public function __construct(
        public int $studentId,
        public int $programId,
        public ?int $moduleId,
        public string $title,
        public string $question,
        public StudentQuestionStatus $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            studentId: (int) $request->input('student_id'),
            programId: (int) $request->input('program_id'),
            moduleId: $request->filled('module_id') ? (int) $request->input('module_id') : null,
            title: $request->string('title')->toString(),
            question: $request->string('question')->toString(),
            status: StudentQuestionStatus::from($request->input('status', StudentQuestionStatus::OPEN->value)),
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->studentId,
            'program_id' => $this->programId,
            'module_id' => $this->moduleId,
            'title' => $this->title,
            'question' => $this->question,
            'status' => $this->status->value,
        ];
    }
}
