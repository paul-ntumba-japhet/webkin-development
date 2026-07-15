<?php

namespace App\Providers;

use App\Models\Assignment;
use App\Models\Cohort;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Setting;
use App\Models\User;
use App\Policies\AssignmentPolicy;
use App\Policies\CohortPolicy;
use App\Policies\EnrollmentPolicy;
use App\Policies\ProgramPolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Program::class, ProgramPolicy::class);
        Gate::policy(Enrollment::class, EnrollmentPolicy::class);
        Gate::policy(Assignment::class, AssignmentPolicy::class);
        Gate::policy(Cohort::class, CohortPolicy::class);
        Gate::policy(Setting::class, SettingPolicy::class);
    }
}
