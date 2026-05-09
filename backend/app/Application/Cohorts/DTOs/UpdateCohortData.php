<?php

namespace App\Application\Cohorts\DTOs;

use App\Domain\Cohorts\Enums\CohortStatus;
use Illuminate\Http\Request;

final readonly class UpdateCohortData
{
    public function __construct(
        public string $name,
        public string $startDate,
        public string $endDate,
        public int $maxStudents,
        public string $price,
        public CohortStatus $status,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            startDate: $request->date('start_date')?->toDateString() ?? now()->toDateString(),
            endDate: $request->date('end_date')?->toDateString() ?? now()->toDateString(),
            maxStudents: (int) $request->input('max_students'),
            price: number_format((float) $request->input('price', 0), 2, '.', ''),
            status: CohortStatus::from($request->input('status')),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'max_students' => $this->maxStudents,
            'price' => $this->price,
            'status' => $this->status->value,
            'notes' => $this->notes,
        ];
    }
}
