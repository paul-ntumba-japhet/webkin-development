<?php

namespace App\Infrastructure\Persistence\Repositories\Assignments;

use App\Domain\Assignments\Repositories\AssignmentSubmissionRepositoryInterface;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentAssignmentSubmissionRepository implements AssignmentSubmissionRepositoryInterface
{
    public function findById(int $id): ?AssignmentSubmission
    {
        return AssignmentSubmission::query()->find($id);
    }
    public function findLatestForAssignmentAndStudent(int $assignmentId, int $studentId): ?AssignmentSubmission
    {
        return AssignmentSubmission::query()->where('assignment_id', $assignmentId)->where('student_id', $studentId)->latest('id')->first();
    }
    public function listByAssignmentId(int $assignmentId): Collection
    {
        return AssignmentSubmission::query()->where('assignment_id', $assignmentId)->latest('id')->get();
    }
    public function create(array $attributes): AssignmentSubmission
    {
        return AssignmentSubmission::query()->create($attributes);
    }
    public function updateStatus(AssignmentSubmission $submission, string $status): AssignmentSubmission
    {
        $modelVar = $submission;
        $modelVar->update(['status' => $status]);

        return $modelVar->refresh();
    }
}
