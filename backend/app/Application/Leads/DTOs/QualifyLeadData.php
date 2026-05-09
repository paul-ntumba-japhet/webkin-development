<?php

namespace App\Application\Leads\DTOs;

use App\Domain\Leads\Enums\LeadStatus;

final readonly class QualifyLeadData
{
    public function toArray(): array
    {
        return ['status' => LeadStatus::QUALIFIED->value];
    }
}
