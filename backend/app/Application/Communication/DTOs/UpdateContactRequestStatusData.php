<?php

namespace App\Application\Communication\DTOs;

use App\Domain\Communication\Enums\ContactRequestStatus;
use Illuminate\Http\Request;

final readonly class UpdateContactRequestStatusData
{
    public function __construct(
        public ContactRequestStatus $status,
        public ?int $handledByUserId = null,
        public ?string $handledAt = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            status: ContactRequestStatus::from($request->input('status')),
            handledByUserId: $request->filled('handled_by_user_id') ? (int) $request->input('handled_by_user_id') : null,
            handledAt: $request->date('handled_at')?->toDateTimeString(),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
            'handled_by_user_id' => $this->handledByUserId,
            'handled_at' => $this->handledAt,
            'notes' => $this->notes,
        ];
    }
}
