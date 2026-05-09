<?php

namespace App\Application\Leads\DTOs;

use App\Domain\Media\Enums\TestimonialStatus;

final readonly class PublishTestimonialData
{
    public function toArray(): array
    {
        return ['status' => TestimonialStatus::APPROVED->value];
    }
}
