<?php

namespace App\Application\Assignments\DTOs;

use Illuminate\Http\Request;

final readonly class ArchiveAssignmentData
{
    public function __construct(
        public ?string $reason = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            reason: $request->filled('reason') ? $request->string('reason')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'is_published' => false,
            'description' => $this->reason,
        ];
    }
}
