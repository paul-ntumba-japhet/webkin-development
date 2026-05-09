<?php

namespace App\Application\Projects\DTOs;

use App\Domain\Assignments\Enums\ProjectMemberRole;
use Illuminate\Http\Request;

final readonly class AddProjectMemberData
{
    public function __construct(
        public int $projectId,
        public int $userId,
        public ProjectMemberRole $roleInProject,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            projectId: (int) $request->input('project_id'),
            userId: (int) $request->input('user_id'),
            roleInProject: ProjectMemberRole::from($request->input('role_in_project')),
        );
    }

    public function toArray(): array
    {
        return [
            'project_id' => $this->projectId,
            'user_id' => $this->userId,
            'role_in_project' => $this->roleInProject->value,
        ];
    }
}
