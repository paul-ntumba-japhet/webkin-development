<?php

namespace App\Domain\SupportMessaging\Services;

use App\Models\SupportConversation;

interface SupportConversationPolicyServiceInterface
{
    public function assertReplyAllowed(SupportConversation $conversation, int $userId): void;
}
