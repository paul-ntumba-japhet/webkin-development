<?php

namespace App\Application\Cohorts\DTOs;

use App\Domain\Cohorts\Enums\CohortStatus;
use Illuminate\Http\Request;

final readonly class ArchiveCohortData
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
            'status' => CohortStatus::CANCELLED->value,
            'notes' => $this->notes,
        ];
    }
}
