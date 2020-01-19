<?php

namespace App\Providers;

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
        //
        $this->app->singleton('App\Repositories\Contracts\UserInterface', function ($app) {
            return new \App\Repositories\Eloquent\UserServiceRepository();
        });

        $this->app->singleton('UserFacadeRepository',function ($app){
            return new \App\Repositories\Eloquent\UserFacadeRepository();
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
