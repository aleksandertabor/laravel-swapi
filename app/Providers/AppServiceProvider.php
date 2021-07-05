<?php

namespace App\Providers;

use App\Clients\Swapi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Swapi::class, function () {
            return new Swapi(
                Http::baseUrl(config('services.swapi.endpoint'))->withHeaders([
                    'accept' => 'application/json',
                ])
                ->withOptions(['verify' => false])
            );
        });
    }
}
