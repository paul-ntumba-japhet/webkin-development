<?php

namespace App\Application\Projects\DTOs;

use App\Domain\Projects\Enums\StudentProjectStatus;
use Illuminate\Http\Request;

final readonly class ArchiveStudentProjectData
{
    public function __construct(
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => StudentProjectStatus::ARCHIVED->value,
            'description' => $this->notes,
        ];
    }
}
