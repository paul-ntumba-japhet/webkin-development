<?php

namespace App\Domain\SupportMessaging\Services;

use App\Domain\SupportMessaging\Services\SupportRoutingServiceInterface;
use App\Models\SupportConversation;

final class DefaultSupportRoutingService implements SupportRoutingServiceInterface
{
    public function resolveAgentId(SupportConversation $conversation): ?int
    {
        return $conversation->assigned_agent_id ?: null;
    }
}

