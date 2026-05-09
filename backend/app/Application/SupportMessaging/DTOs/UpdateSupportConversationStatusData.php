<?php

namespace App\Application\SupportMessaging\DTOs;

use App\Domain\Communication\Enums\SupportConversationStatus;
use Illuminate\Http\Request;

final readonly class UpdateSupportConversationStatusData
{
    public function __construct(
        public SupportConversationStatus $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            status: SupportConversationStatus::from($request->input('status')),
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
        ];
    }
}
