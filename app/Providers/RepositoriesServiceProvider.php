<?php

namespace App\Providers;

use App\Repositories\SwapiRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CharacterRepository;
use App\Repositories\SwapiRepositoryInterface;
use App\Repositories\CharacterRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CharacterRepositoryInterface::class, CharacterRepository::class);
        $this->app->bind(SwapiRepositoryInterface::class, SwapiRepository::class);
    }
}
