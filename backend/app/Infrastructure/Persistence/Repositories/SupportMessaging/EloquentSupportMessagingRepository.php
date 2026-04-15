<?php

namespace App\Infrastructure\Persistence\Repositories\SupportMessaging;

use App\Domain\SupportMessaging\Repositories\SupportMessageRepositoryInterface;
use App\Models\SupportMessage;
use Illuminate\Support\Collection;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentSupportMessageRepository implements SupportMessageRepositoryInterface
{
    public function listByConversationId(int $conversationId): Collection
    {
        return SupportMessage::query()->where('support_conversation_id', $conversationId)->oldest('id')->get();
    }
    public function create(array $attributes): SupportMessage
    {
        return SupportMessage::query()->create($attributes);
    }
}
