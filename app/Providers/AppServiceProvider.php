<?php

namespace App\Providers;

use App\Repositories\Interfaces\UploadsRepositoryInterface;
use App\Repositories\UploadsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UploadsRepositoryInterface::class, UploadsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
