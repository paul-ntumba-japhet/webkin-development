<?php

namespace App\Application\Communication\DTOs;

use App\Domain\Communication\Enums\NotificationType;
use Illuminate\Http\Request;

final readonly class SendNotificationData
{
    public function __construct(
        public int $userId,
        public NotificationType $type,
        public string $title,
        public string $content,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            userId: (int) $request->input('user_id'),
            type: NotificationType::from($request->input('type')),
            title: $request->string('title')->toString(),
            content: $request->string('content')->toString(),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'type' => $this->type->value,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
