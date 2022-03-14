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
        $this->app->bind('App\Repositories\EloquentRepositoryInterface', 'App\Repositories\Eloquent\BaseRepository');
        $this->app->bind('App\Repositories\TopicRepositoryInterface', 'App\Repositories\Eloquent\TopicRepository');
        $this->app->bind('App\Repositories\NewsRepositoryInterface', 'App\Repositories\Eloquent\NewsRepository');
        $this->app->bind('App\Repositories\TagRepositoryInterface', 'App\Repositories\Eloquent\TagRepository');
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