<?php

namespace App\Application\Cohorts\DTOs;

use Illuminate\Http\Request;

final readonly class UpdateRoomData
{
    public function __construct(
        public string $name,
        public ?string $location,
        public ?int $capacity,
        public ?string $description,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            location: $request->filled('location') ? $request->string('location')->toString() : null,
            capacity: $request->filled('capacity') ? (int) $request->input('capacity') : null,
            description: $request->filled('description') ? $request->string('description')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'description' => $this->description,
        ];
    }
}
