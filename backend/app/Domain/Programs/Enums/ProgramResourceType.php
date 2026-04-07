<?php

namespace App\Domain\Programs\Enums;

enum ProgramResourceType: string
{
    case FILE = 'file';
    case LINK = 'link';
    case VIDEO = 'video';
    case REPOSITORY = 'repository';
}
