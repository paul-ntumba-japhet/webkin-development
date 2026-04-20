<?php

namespace App\Domain\Mentoring\Services;

use App\Domain\Mentoring\Services\MentorshipSchedulingPolicyInterface;
use DomainException;

final class DefaultMentorshipSchedulingPolicyService implements MentorshipSchedulingPolicyInterface
{
    public function assertReservable(array $attributes): void
    {
        if (empty($attributes['mentor_id']) || empty($attributes['starts_at']) || empty($attributes['ends_at'])) {
            throw new DomainException('mentor_id, starts_at et ends_at sont requis.');
        }
    }
}
