<?php

namespace App\Domain\SupportMessaging\Services;

use App\Models\SupportConversation;

interface SupportRoutingServiceInterface
{
    public function resolveAgentId(SupportConversation $conversation): ?int;
}

