<?php

namespace App\Application\Leads\DTOs;

use App\Domain\Media\Enums\TestimonialStatus;

final readonly class ArchiveTestimonialData
{
    public function toArray(): array
    {
        return ['status' => TestimonialStatus::REJECTED->value];
    }
}
