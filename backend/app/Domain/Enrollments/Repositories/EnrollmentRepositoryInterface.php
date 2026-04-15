<?php

namespace App\Infrastructure\Persistence\Repositories\Enrollments;

use App\Domain\Enrollments\Repositories\EnrollmentRepositoryInterface;
use App\Models\Enrollment;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EloquentEnrollmentRepository implements EnrollmentRepositoryInterface
{
    public function findById(int $id): ?Enrollment
    {
        return Enrollment::query()->find($id);
    }
    public function findActiveForStudentAndProgram(int $studentId, int $programId): ?Enrollment
    {
        return Enrollment::query()->where('student_id', $studentId)->where('program_id', $programId)->whereIn('status', ['pending', 'approved', 'active'])->latest('id')->first();
    }
    public function paginateForStudent(int $studentId, int $perPage = 15): LengthAwarePaginator
    {
        return Enrollment::query()->where('student_id', $studentId)->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): Enrollment
    {
        return Enrollment::query()->create($attributes);
    }
    public function updateStatus(Enrollment $enrollment, string $status): Enrollment
    {
        $modelVar = $enrollment;
        $modelVar->update(['status' => $status]);

        return $modelVar->refresh();
    }
    public function delete(Enrollment $enrollment): bool
    {
        return $enrollment->delete();
    }
}



