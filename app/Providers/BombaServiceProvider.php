<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BombaService;

class BombaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(BombaService::class, function ($app){
            return new BombaService();
        });

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
