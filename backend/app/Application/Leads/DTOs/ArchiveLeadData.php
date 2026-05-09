<?php

namespace App\Application\Leads\DTOs;

use App\Domain\Leads\Enums\LeadStatus;

final readonly class ArchiveLeadData
{
    public function toArray(): array
    {
        return ['status' => LeadStatus::CLOSED->value];
    }
}
