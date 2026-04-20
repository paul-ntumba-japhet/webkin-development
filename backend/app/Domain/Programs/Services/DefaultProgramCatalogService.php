<?php

namespace App\Domain\Programs\Services;

use App\Domain\Programs\Services\ProgramCatalogServiceInterface;
use App\Models\Program;
use App\Domain\Programs\Repositories\ProgramRepositoryInterface;
use App\Domain\Programs\Services\ProgramPublishingPolicyServiceInterface;

final class DefaultProgramCatalogService implements ProgramCatalogServiceInterface
{
    public function __construct(
        private readonly ProgramRepositoryInterface $programs,
        private readonly ProgramPublishingPolicyServiceInterface $publishingPolicy,
    ) {
    }

    public function publish(Program $program): Program
    {
        $this->publishingPolicy->assertPublishable($program);

        return $this->programs->update($program, ['status' => 'published']);
    }

    public function archive(Program $program): Program
    {
        return $this->programs->update($program, ['status' => 'archived']);
    }
}
