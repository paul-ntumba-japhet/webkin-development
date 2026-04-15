<?php

namespace App\Domain\Projects\Repositories;

use App\Models\ProjectMember;
use Illuminate\Support\Collection;
use App\Models\StudentProject;

interface ProjectMemberRepositoryInterface
{
    public function listByProjectId(int $projectId): Collection;
    public function syncMembers(StudentProject $project, array $rows): Collection;
    public function addMember(array $attributes): ProjectMember;
    public function removeMember(ProjectMember $member): bool;
}


