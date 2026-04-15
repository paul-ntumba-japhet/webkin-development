<?php


namespace App\Domain\Assignments\Repositories;

use App\Models\AssignmentSubmission;
use Illuminate\Support\Collection;

interface AssignmentSubmissionRepositoryInterface
{
    public function findById(int $id): ?AssignmentSubmission;
    public function findLatestForAssignmentAndStudent(int $assignmentId, int $studentId): ?AssignmentSubmission;
    public function listByAssignmentId(int $assignmentId): Collection;
    public function create(array $attributes): AssignmentSubmission;
    public function updateStatus(AssignmentSubmission $submission, string $status): AssignmentSubmission;
}
