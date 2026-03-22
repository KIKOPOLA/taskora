<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Task;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Pagination\Paginator;
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
        // Use Tailwind pagination
        Paginator::useTailwind();

        // Register Policies
        $this->registerPolicies();
    }

    /**
     * Register authorization policies.
     */
    private function registerPolicies(): void
    {
        \Illuminate\Support\Facades\Gate::policy(Project::class, ProjectPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(Task::class, TaskPolicy::class);
    }
}
