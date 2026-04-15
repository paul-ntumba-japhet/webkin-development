<?php

namespace App\Infrastructure\Persistence\Repositories\Platform;

use App\Domain\Platform\Repositories\TestimonialRepositoryInterface;
use App\Models\Testimonial;
//use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\DB;

final class EloquentTestimonialRepository implements TestimonialRepositoryInterface
{
    public function listPublished(int $limit = 20): LengthAwarePaginator
    {
        return Testimonial::query()->where('status', 'published')->latest('id')->paginate($limit);
    }
    public function create(array $attributes): Testimonial
    {
        return Testimonial::query()->create($attributes);
    }
    public function update(Testimonial $testimonial, array $attributes): Testimonial
    {
        $testimonial->update($attributes);

        return $testimonial->refresh();
    }
    public function delete(Testimonial $testimonial): bool
    {
        return $testimonial->delete();
    }
}
