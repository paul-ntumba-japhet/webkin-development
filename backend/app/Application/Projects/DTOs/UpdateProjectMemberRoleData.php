<?php

namespace App\Application\Projects\DTOs;

use App\Domain\Assignments\Enums\ProjectMemberRole;
use Illuminate\Http\Request;

final readonly class UpdateProjectMemberRoleData
{
    public function __construct(
        public ProjectMemberRole $roleInProject,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            roleInProject: ProjectMemberRole::from($request->input('role_in_project')),
        );
    }

    public function toArray(): array
    {
        return ['role_in_project' => $this->roleInProject->value];
    }
}
