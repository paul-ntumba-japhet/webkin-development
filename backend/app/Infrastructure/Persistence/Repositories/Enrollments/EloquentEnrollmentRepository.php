<?php

namespace App\Domain\Enrollments\Repositories;

use App\Models\Enrollment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EnrollmentRepositoryInterface
{
    public function findById(int $id): ?Enrollment;
    public function findActiveForStudentAndProgram(int $studentId, int $programId): ?Enrollment;
    public function paginateForStudent(int $studentId, int $perPage = 15): LengthAwarePaginator;
    public function create(array $attributes): Enrollment;
    public function updateStatus(Enrollment $enrollment, string $status): Enrollment;
    public function delete(Enrollment $enrollment): bool;
}
