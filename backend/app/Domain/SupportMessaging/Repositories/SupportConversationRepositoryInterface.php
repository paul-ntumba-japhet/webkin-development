<?php

namespace App\Domain\SupportMessaging\Repositories;

use App\Models\SupportConversation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SupportConversationRepositoryInterface
{
    public function findById(int $id): ?SupportConversation;
    public function listForUser(int $userId, int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): SupportConversation;
    public function updateStatus(SupportConversation $conversation, string $status): SupportConversation;
    public function assignAgent(SupportConversation $conversation, int $agentId): SupportConversation;
}


