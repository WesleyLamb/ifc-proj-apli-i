<?php

namespace App\Providers;

use App\Http\Repositories\ApplicationRepository;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Repositories\Contracts\AuthRepositoryInterface;
use App\Http\Repositories\Contracts\EstablishmentRepositoryInterface;
use App\Http\Repositories\Contracts\ModuleRepositoryInterface;
use App\Http\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Repositories\EstablishmentRepository;
use App\Http\Repositories\ModuleRepository;
use App\Http\Repositories\UserRepository;
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

        $this->app->bind(
            EstablishmentRepositoryInterface::class,
            EstablishmentRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
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
