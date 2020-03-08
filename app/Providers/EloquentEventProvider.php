<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EloquentEventProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App\User::observe(App\Observer\UserObserver::class);
        App\Models\Article::observe(App\Observer\ArticleObserver::class);
        App\Models\Department::observe(App\Observer\DepartmentObserver::class);
        App\Models\Category::observe(App\Observer\CategoryObserver::class);
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
