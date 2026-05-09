<?php

namespace App\Application\Assignments\DTOs;

use App\Domain\Assignments\Enums\AssignmentType;
use Illuminate\Http\Request;

final readonly class CreateAssignmentData
{
    public function __construct(
        public int $programId,
        public ?int $moduleId,
        public ?int $lessonId,
        public int $cohortId,
        public string $title,
        public ?string $description,
        public AssignmentType $assignmentType,
        public ?string $dueDate,
        public string $maxScore,
        public bool $isPublished,
        public int $createdBy,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            programId: (int) $request->input('program_id'),
            moduleId: $request->filled('module_id') ? (int) $request->input('module_id') : null,
            lessonId: $request->filled('lesson_id') ? (int) $request->input('lesson_id') : null,
            cohortId: (int) $request->input('cohort_id'),
            title: $request->string('title')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            assignmentType: AssignmentType::from($request->input('assignment_type')),
            dueDate: $request->date('due_date')?->toDateTimeString(),
            maxScore: number_format((float) $request->input('max_score', 100), 2, '.', ''),
            isPublished: $request->boolean('is_published'),
            createdBy: (int) $request->input('created_by'),
        );
    }

    public function toArray(): array
    {
        return [
            'program_id' => $this->programId,
            'module_id' => $this->moduleId,
            'lesson_id' => $this->lessonId,
            'cohort_id' => $this->cohortId,
            'title' => $this->title,
            'description' => $this->description,
            'assignment_type' => $this->assignmentType->value,
            'due_date' => $this->dueDate,
            'max_score' => $this->maxScore,
            'is_published' => $this->isPublished,
            'created_by' => $this->createdBy,
        ];
    }
}
