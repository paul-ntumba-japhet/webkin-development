<?php


namespace App\Domain\Projects\Services;

use App\Domain\Projects\Services\ProjectMembershipPolicyServiceInterface;
use App\Models\StudentProject;
use DomainException;

final class DefaultProjectMembershipPolicyService implements ProjectMembershipPolicyServiceInterface
{
    public function assertMembersAllowed(StudentProject $project, array $rows): void
    {
        $memberIds = array_filter(array_column($rows, 'user_id'));

        if (count($memberIds) !== count(array_unique($memberIds))) {
            throw new DomainException('Un même membre ne peut pas apparaître plusieurs fois dans un projet.');
        }
    }
}
