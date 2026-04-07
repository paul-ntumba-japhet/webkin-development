<?php

namespace App\Domain\Programs\Enums;

enum ProgramShowcaseType: string
{
    case VIDEO = 'video';
    case IMAGE = 'image';
    case CASE_TYPE = 'case_type';
    case DEMO = 'demo';
}
