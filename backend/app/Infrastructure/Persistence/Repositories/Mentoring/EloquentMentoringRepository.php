<?php

namespace App\Infrastructure\Persistence\Repositories\Mentoring;

use App\Domain\Mentoring\Repositories\MentorshipSessionRepositoryInterface;
use App\Models\MentorshipSession;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentMentorshipSessionRepository implements MentorshipSessionRepositoryInterface
{
    public function findById(int $id): ?MentorshipSession
    {
        return MentorshipSession::query()->find($id);
    }
    public function listForMentor(int $mentorId, int $perPage = 20): LengthAwarePaginator
    {
        return MentorshipSession::query()->where('mentor_id', $mentorId)->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): MentorshipSession
    {
        return MentorshipSession::query()->create($attributes);
    }
    public function update(MentorshipSession $session, array $attributes): MentorshipSession
    {
        $session->update($attributes);

        return $session->refresh();
    }
    public function cancel(MentorshipSession $session): MentorshipSession
    {
        $session->update(['status' => 'cancelled']);

        return $session->refresh();
    }
}
