<?php

namespace App\Domain\Media\Services;

interface MediaOwnershipPolicyServiceInterface
{
    public function assertAttachable(string $ownerType, int $ownerId): void;
}
