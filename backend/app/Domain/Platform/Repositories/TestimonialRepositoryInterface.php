<?php

namespace App\Domain\Platform\Repositories;

use App\Models\Testimonial;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TestimonialRepositoryInterface
{
    public function listPublished(int $limit = 20): LengthAwarePaginator;
    public function create(array $attributes): Testimonial;
    public function update(Testimonial $testimonial, array $attributes): Testimonial;
    public function delete(Testimonial $testimonial): bool;
}
