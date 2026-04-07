<?php

namespace App\Domain\Programs\Enums;

enum LessonType : string
{
    case TEXT = 'text';
    case VIDEO = 'video';
    case LIVE = 'live';
    case QUIZ = 'quiz';
    case PROJECT = 'project';

}
