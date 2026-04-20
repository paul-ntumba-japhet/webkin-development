<?php

namespace App\Domain\Media\Services;

use App\Domain\Media\Services\MediaOwnershipPolicyServiceInterface;
use DomainException;

final class DefaultMediaOwnershipPolicyService implements MediaOwnershipPolicyServiceInterface
{
    public function assertAttachable(string $ownerType, int $ownerId): void
    {
        if ($ownerType === '' || $ownerId <= 0) {
            throw new DomainException('Le propriétaire du média est invalide.');
        }
    }
}
