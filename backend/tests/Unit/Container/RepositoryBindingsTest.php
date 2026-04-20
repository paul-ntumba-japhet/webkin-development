<?php


use App\Domain\Platform\Repositories\TestimonialRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\Platform\EloquentTestimonialRepository;
use App\Domain\Programs\Repositories\ProgramRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\Programs\EloquentProgramRepository;

it('resolves testimonial repository interface', function () {
    $repository = app(TestimonialRepositoryInterface::class);

    expect($repository)->toBeInstanceOf(EloquentTestimonialRepository::class);
});

it('resolves program repository interface', function () {
    $repository = app(ProgramRepositoryInterface::class);

    expect($repository)->toBeInstanceOf(EloquentProgramRepository::class);
});
