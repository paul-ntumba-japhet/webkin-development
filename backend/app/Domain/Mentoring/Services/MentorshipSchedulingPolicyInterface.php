<?php

namespace App\Domain\Mentoring\Services;



interface MentorshipSchedulingPolicyInterface
{
    public function assertReservable(array $attributes): void;
}
