<?php

namespace App\Application\SupportMessaging\DTOs;

use Illuminate\Http\Request;

final readonly class CreateSupportMessageData
{
    public function __construct(
        public int $conversationId,
        public int $senderId,
        public string $message,
        public ?int $attachmentMediaId,
        public bool $isInternal = false,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            conversationId: (int) $request->input('conversation_id'),
            senderId: (int) $request->input('sender_id'),
            message: $request->string('message')->toString(),
            attachmentMediaId: $request->filled('attachment_media_id') ? (int) $request->input('attachment_media_id') : null,
            isInternal: $request->boolean('is_internal'),
        );
    }

    public function toArray(): array
    {
        return [
            'conversation_id' => $this->conversationId,
            'sender_id' => $this->senderId,
            'message' => $this->message,
            'attachment_media_id' => $this->attachmentMediaId,
            'is_internal' => $this->isInternal,
        ];
    }
}
