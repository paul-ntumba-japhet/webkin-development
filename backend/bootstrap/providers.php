<?php

use App\Providers\AppServiceProvider;
use App\Providers\DomainServiceProvider;
use App\Providers\InfrastructureServiceProvider;
use App\Providers\RepositoryServiceProvider;

return [
    AppServiceProvider::class,
    DomainServiceProvider::class,
    InfrastructureServiceProvider::class,
    RepositoryServiceProvider::class,
];
