<?php

namespace App\Domain\Projects\Services;

use App\Models\StudentProject;

interface ProjectMembershipPolicyServiceInterface
{
    public function assertMembersAllowed(StudentProject $project, array $rows): void;
}
