<?php

namespace App\Domain\Mentoring\Repositories;

use App\Models\MentorshipSession;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MentorshipSessionRepositoryInterface
{
    public function findById(int $id): ?MentorshipSession;
    public function listForMentor(int $mentorId, int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): MentorshipSession;
    public function update(MentorshipSession $session, array $attributes): MentorshipSession;
    public function cancel(MentorshipSession $session): MentorshipSession;
}


