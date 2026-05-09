<?php

namespace App\Application\Projects\DTOs;

use Illuminate\Http\Request;

final readonly class RemoveProjectMemberData
{
    public function __construct(
        public int $projectId,
        public int $userId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            projectId: (int) $request->input('project_id'),
            userId: (int) $request->input('user_id'),
        );
    }

    public function toArray(): array
    {
        return [
            'project_id' => $this->projectId,
            'user_id' => $this->userId,
        ];
    }
}
