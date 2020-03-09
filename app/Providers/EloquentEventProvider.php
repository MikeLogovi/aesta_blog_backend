<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\DepartmentObserver;
class EloquentEventProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \App\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Article::observe(\App\Observers\ArticleObserver::class);
        \App\Models\Department::observe(\App\Observers\DepartmentObserver::class);
       \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
    }
}
