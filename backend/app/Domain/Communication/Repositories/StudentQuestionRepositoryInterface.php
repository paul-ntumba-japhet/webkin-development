<?php

namespace App\Domain\Communication\Repositories;

use App\Models\StudentQuestion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface StudentQuestionRepositoryInterface
{
    public function findById(int $id): ?StudentQuestion;
    public function listOpen(int $perPage = 20): LengthAwarePaginator;
    public function create(array $attributes): StudentQuestion;
    public function updateStatus(StudentQuestion $question, string $status): StudentQuestion;
}
