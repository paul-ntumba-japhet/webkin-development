<?php


namespace App\Infrastructure\Persistence\Repositories\Projects;

use App\Domain\Projects\Repositories\ProjectMemberRepositoryInterface;
use App\Models\ProjectMember;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\StudentProject;

final class EloquentProjectMemberRepository implements ProjectMemberRepositoryInterface
{
    public function listByProjectId(int $projectId): Collection
    {
        return ProjectMember::query()->where('student_project_id', $projectId)->latest('id')->get();
    }
    public function syncMembers(StudentProject $project, array $rows): Collection
    {
        return DB::transaction(function () use ($project, $rows) {
            ProjectMember::query()->where('student_project_id', $project->id)->delete();

            $items = collect();

            foreach ($rows as $row) {
                $row['student_project_id'] = $project->id;
                $items->push(ProjectMember::query()->create($row));
            }

            return $items;
        });
    }
    public function addMember(array $attributes): ProjectMember
    {
        return ProjectMember::query()->create($attributes);
    }
    public function removeMember(ProjectMember $member): bool
    {
        return $member->delete();
    }
}
