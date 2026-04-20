<?php

namespace App\Domain\Leads\Services;

use App\Models\Lead;

interface LeadScoringServiceInterface
{
    public function score(Lead $lead): int;
}

