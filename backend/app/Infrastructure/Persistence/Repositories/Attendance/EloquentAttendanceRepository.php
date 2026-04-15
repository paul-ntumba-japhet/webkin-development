<?php


namespace App\Infrastructure\Persistence\Repositories\Attendance;

use App\Domain\Attendance\Repositories\AttendanceRepositoryInterface;
use App\Models\Attendance;
use Illuminate\Support\Collection;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentAttendanceRepository implements AttendanceRepositoryInterface
{
    public function findById(int $id): ?Attendance
    {
        return Attendance::query()->find($id);
    }
    public function findForEnrollmentAndDate(int $enrollmentId, string $date): ?Attendance
    {
        return Attendance::query()->where('enrollment_id', $enrollmentId)->whereDate('session_date', $date)->first();
    }
    public function listByCohortAndDate(int $cohortId, string $date): Collection
    {
        return Attendance::query()->where('cohort_id', $cohortId)->whereDate('session_date', $date)->get();
    }
    public function createOrUpdate(array $attributes): Attendance
    {
        return Attendance::query()->updateOrCreate(
            [
                'enrollment_id' => $attributes['enrollment_id'],
                'session_date' => $attributes['session_date'],
            ],
            $attributes
        );
    }
}
