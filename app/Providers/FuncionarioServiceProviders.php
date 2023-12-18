<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FuncionarioService;

class FuncionarioServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
         
        $this->app->singleton(FuncionarioService::class, function ($app){
            return new FuncionarioService();
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
