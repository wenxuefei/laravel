<?php

namespace App\Providers;

use App\Models\Topic;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::Composer('home.layout.sidebar',function ($view){
            $topics = Topic::all();
            $view->with('topics',$topics);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
