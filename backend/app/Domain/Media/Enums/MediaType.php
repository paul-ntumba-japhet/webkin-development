<?php

namespace App\Domain\Media\Enums;

enum MediaType: string
{
    case VIDEO = 'video';
    case IMAGE = 'image';
    case DOCUMENT = 'document';
    case AUDIO = 'audio';
}
