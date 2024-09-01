<?php

namespace App\Providers;

use App\Services\TasksService;
use App\Services\ProjectsService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Service\TasksServieContract;
use App\Contracts\Service\ProjectsServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectsServiceContract::class, ProjectsService::class);
        $this->app->bind(TasksServieContract::class, TasksService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
