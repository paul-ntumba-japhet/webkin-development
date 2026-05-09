<?php

namespace App\Application\Assignments\DTOs;

final readonly class PublishAssignmentData
{
    public function toArray(): array
    {
        return ['is_published' => true];
    }
}
