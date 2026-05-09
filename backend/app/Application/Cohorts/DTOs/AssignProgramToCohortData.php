<?php

namespace App\Application\Cohorts\DTOs;

use Illuminate\Http\Request;

final readonly class AssignProgramToCohortData
{
    public function __construct(
        public int $programId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            programId: (int) $request->input('program_id'),
        );
    }

    public function toArray(): array
    {
        return ['program_id' => $this->programId];
    }
}
