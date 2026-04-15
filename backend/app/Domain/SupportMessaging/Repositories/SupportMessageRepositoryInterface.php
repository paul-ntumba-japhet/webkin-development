<?php

namespace App\Domain\SupportMessaging\Repositories;

use App\Models\SupportMessage;
use Illuminate\Support\Collection;

interface SupportMessageRepositoryInterface
{
    public function listByConversationId(int $conversationId): Collection;
    public function create(array $attributes): SupportMessage;
}
