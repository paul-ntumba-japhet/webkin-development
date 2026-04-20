<?php

namespace App\Domain\Leads\Services;

use App\Domain\Leads\Services\LeadScoringServiceInterface;
use App\Models\Lead;

final class DefaultLeadScoringService implements LeadScoringServiceInterface
{
    public function score(Lead $lead): int
    {
        $score = 0;
        $score += filled($lead->email ?? null) ? 20 : 0;
        $score += filled($lead->phone ?? null) ? 20 : 0;
        $score += filled($lead->message ?? null) ? 30 : 0;

        return min($score, 100);
    }
}
