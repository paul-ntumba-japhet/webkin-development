<?php


namespace App\Domain\Projects\Enums;

enum StudentProjectStatus: string
{
    case DRAFT = 'draft';
    case IN_REVIEW = 'in_review';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
