<?php

namespace App\Domain\Mentoring\Enums;

enum MentorshipMode: string
{
    case ONLINE = 'online';
    case ONSITE = 'onsite';
}
