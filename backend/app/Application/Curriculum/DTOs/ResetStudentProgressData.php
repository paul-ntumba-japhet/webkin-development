<?php

namespace App\Application\Curriculum\DTOs;

final readonly class ResetStudentProgressData
{
    public function toArray(): array
    {
        return [
            'progress_percent' => 0,
            'completed_at' => null,
            'last_accessed_at' => now()->toDateTimeString(),
        ];
    }
}
