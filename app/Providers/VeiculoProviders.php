<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\VeiculoService;

class VeiculoProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->singleton(VeiculoService::class, function ($app){
            return new VeiculoService();
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
