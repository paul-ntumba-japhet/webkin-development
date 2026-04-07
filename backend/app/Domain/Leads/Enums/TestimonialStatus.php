<?php

namespace App\Domain\Media\Enums;

enum TestimonialStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
