<?php

namespace App\Domain\Programs\Services;
use App\Models\Program;

interface ProgramCatalogServiceInterface
{
    public function publish(Program $program): Program;
    public function archive(Program $program): Program;
}
