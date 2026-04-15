<?php

namespace App\Infrastructure\Persistence\Repositories\SupportMessaging;

use App\Domain\SupportMessaging\Repositories\SupportConversationRepositoryInterface;
use App\Models\SupportConversation;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentSupportConversationRepository implements SupportConversationRepositoryInterface
{
    public function findById(int $id): ?SupportConversation
    {
        return SupportConversation::query()->find($id);
    }
    public function listForUser(int $userId, int $perPage = 20): LengthAwarePaginator
    {
        return SupportConversation::query()->where('user_id', $userId)->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): SupportConversation
    {
        return SupportConversation::query()->create($attributes);
    }
    public function updateStatus(SupportConversation $conversation, string $status): SupportConversation
    {
        $modelVar = $conversation;
        $modelVar->update(['status' => $status]);

        return $modelVar->refresh();
    }
    public function assignAgent(SupportConversation $conversation, int $agentId): SupportConversation
    {
        $conversation->update(['assigned_agent_id' => $agentId]);

        return $conversation->refresh();
    }
}
