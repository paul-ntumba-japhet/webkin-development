<?php

namespace App\Application\SupportMessaging\DTOs;

use App\Domain\Communication\Enums\SupportConversationStatus;
use App\Domain\Support\Enums\SupportCategory;
use App\Domain\Support\Enums\SupportPriority;
use Illuminate\Http\Request;

final readonly class CreateSupportConversationData
{
    public function __construct(
        public int $studentId,
        public ?int $enrollmentId,
        public ?int $assignedToUserId,
        public string $subject,
        public SupportCategory $category,
        public SupportConversationStatus $status,
        public SupportPriority $priority,
        public ?string $lastMessageAt = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            studentId: (int) $request->input('student_id'),
            enrollmentId: $request->filled('enrollment_id') ? (int) $request->input('enrollment_id') : null,
            assignedToUserId: $request->filled('assigned_to_user_id') ? (int) $request->input('assigned_to_user_id') : null,
            subject: $request->string('subject')->toString(),
            category: SupportCategory::from($request->input('category', SupportCategory::GENERAL->value)),
            status: SupportConversationStatus::from($request->input('status', SupportConversationStatus::OPEN->value)),
            priority: SupportPriority::from($request->input('priority', SupportPriority::NORMAL->value)),
            lastMessageAt: $request->date('last_message_at')?->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->studentId,
            'enrollment_id' => $this->enrollmentId,
            'assigned_to_user_id' => $this->assignedToUserId,
            'subject' => $this->subject,
            'category' => $this->category->value,
            'status' => $this->status->value,
            'priority' => $this->priority->value,
            'last_message_at' => $this->lastMessageAt,
        ];
    }
}
