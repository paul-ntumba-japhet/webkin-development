<?php

namespace App\Infrastructure\Persistence\Repositories\Communication;

use App\Domain\Communication\Repositories\StudentQuestionRepositoryInterface;
use App\Models\StudentQuestion;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentStudentQuestionRepository implements StudentQuestionRepositoryInterface
{
    public function findById(int $id): ?StudentQuestion
    {
        return StudentQuestion::query()->find($id);
    }
    public function listOpen(int $perPage = 20): LengthAwarePaginator
    {
        return StudentQuestion::query()->whereIn('status', ['open', 'pending'])->latest('id')->paginate($perPage);
    }
    public function create(array $attributes): StudentQuestion
    {
        return StudentQuestion::query()->create($attributes);
    }
    public function updateStatus(StudentQuestion $question, string $status): StudentQuestion
    {
        $modelVar = $question;
        $modelVar->update(['status' => $status]);

        return $modelVar->refresh();
    }
}
