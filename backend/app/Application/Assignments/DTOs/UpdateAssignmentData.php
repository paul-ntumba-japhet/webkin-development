<?php

namespace App\Application\Assignments\DTOs;

use App\Domain\Assignments\Enums\AssignmentType;
use Illuminate\Http\Request;

final readonly class UpdateAssignmentData
{
    public function __construct(
        public ?int $moduleId,
        public ?int $lessonId,
        public string $title,
        public ?string $description,
        public AssignmentType $assignmentType,
        public ?string $dueDate,
        public string $maxScore,
        public bool $isPublished,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            moduleId: $request->filled('module_id') ? (int) $request->input('module_id') : null,
            lessonId: $request->filled('lesson_id') ? (int) $request->input('lesson_id') : null,
            title: $request->string('title')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            assignmentType: AssignmentType::from($request->input('assignment_type')),
            dueDate: $request->date('due_date')?->toDateTimeString(),
            maxScore: number_format((float) $request->input('max_score', 100), 2, '.', ''),
            isPublished: $request->boolean('is_published'),
        );
    }

    public function toArray(): array
    {
        return [
            'module_id' => $this->moduleId,
            'lesson_id' => $this->lessonId,
            'title' => $this->title,
            'description' => $this->description,
            'assignment_type' => $this->assignmentType->value,
            'due_date' => $this->dueDate,
            'max_score' => $this->maxScore,
            'is_published' => $this->isPublished,
        ];
    }
}
