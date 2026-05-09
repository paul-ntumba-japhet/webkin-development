<?php

namespace App\Application\SupportMessaging\DTOs;

use Illuminate\Http\Request;

final readonly class AssignSupportConversationData
{
    public function __construct(
        public ?int $assignedToUserId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            assignedToUserId: $request->filled('assigned_to_user_id') ? (int) $request->input('assigned_to_user_id') : null,
        );
    }

    public function toArray(): array
    {
        return ['assigned_to_user_id' => $this->assignedToUserId];
    }
}
