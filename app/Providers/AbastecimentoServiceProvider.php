<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AbastecimentoService;

class AbastecimentoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->singleton(AbastecimentoService::class, function ($app){
            return new AbastecimentoService();
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
