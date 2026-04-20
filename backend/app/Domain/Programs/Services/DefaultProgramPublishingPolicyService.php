<?php

namespace App\Domain\Programs\Services;

use App\Domain\Programs\Services\ProgramPublishingPolicyServiceInterface;
use App\Models\Program;
use DomainException;

final class DefaultProgramPublishingPolicyService implements ProgramPublishingPolicyServiceInterface
{
    public function assertPublishable(Program $program): void
    {
        if (blank($program->title) || blank($program->slug)) {
            throw new DomainException('Le programme doit posséder un titre et un slug.');
        }

        if (! in_array($program->status, ['draft', 'review', 'published', 'archived'], true)) {
            throw new DomainException('Le statut du programme est invalide.');
        }
    }
}

