<?php

namespace App\Providers;

use App\Packages\Coupon\Repositories\Contracts\CouponCollectionRepository;
use App\Packages\Coupon\Repositories\Contracts\CouponProductRepository;
use App\Packages\Coupon\Repositories\Contracts\CouponRepository;
use App\Packages\Coupon\Repositories\Contracts\ProductRepository;
use App\Packages\Coupon\Repositories\Contracts\ProductVariationRepository;
use App\Repositories\Eloquent\EloquentCouponCollectionRepository;
use App\Repositories\Eloquent\EloquentCouponProductRepository;
use App\Repositories\Eloquent\EloquentCouponRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Repositories\Eloquent\EloquentProductVariationRepository;
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
        $this->app->bind(CouponRepository::class, EloquentCouponRepository::class);
        $this->app->bind(CouponCollectionRepository::class, EloquentCouponCollectionRepository::class);
        $this->app->bind(CouponProductRepository::class, EloquentCouponProductRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(ProductVariationRepository::class, EloquentProductVariationRepository::class);
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
