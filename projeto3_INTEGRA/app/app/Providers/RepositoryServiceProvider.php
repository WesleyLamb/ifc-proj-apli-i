<?php

namespace App\Providers;

use App\Http\Repositories\ApplicationRepository;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Repositories\Contracts\AuthRepositoryInterface;
use App\Http\Repositories\Contracts\ModuleRepositoryInterface;
use App\Http\Repositories\ModuleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            ApplicationRepositoryInterface::class,
            ApplicationRepository::class
        );

        $this->app->bind(
            ModuleRepositoryInterface::class,
            ModuleRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
