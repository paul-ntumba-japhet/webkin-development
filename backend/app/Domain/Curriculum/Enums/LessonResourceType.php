<?php

namespace App\Domain\Curriculum\Enums;

enum LessonResourceType: string
{
    case DOCUMENT = 'document';
    case LINK = 'link';
    case VIDEO = 'video';
    case CODE = 'code';
}
