<?php


namespace App\Domain\Curriculum\Enums;

enum ProgramOutcomeProjectStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
