<?php

declare(strict_types=1);

namespace App\Providers;

use Task\Repositories\TaskRepository;
use Illuminate\Support\ServiceProvider;
use Task\Contracts\Repositories\TaskRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
