<?php

namespace App\Domain\Assignments\Enums;

enum AssignmentType: string
{
    case HOMEWORK = 'homework';
    case QUIZ = 'quiz';
    case PROJECT = 'project';
    case EXAM = 'exam';
}
