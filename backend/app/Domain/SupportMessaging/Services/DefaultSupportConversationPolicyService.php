<?php

namespace App\Domain\SupportMessaging\Services;

use App\Domain\SupportMessaging\Services\SupportConversationPolicyServiceInterface;
use App\Models\SupportConversation;
use DomainException;

final class DefaultSupportConversationPolicyService implements SupportConversationPolicyServiceInterface
{
    public function assertReplyAllowed(SupportConversation $conversation, int $userId): void
    {
        if (in_array($conversation->status, ['resolved', 'closed'], true)) {
            throw new DomainException('Cette conversation ne peut plus recevoir de réponse.');
        }
    }
}
