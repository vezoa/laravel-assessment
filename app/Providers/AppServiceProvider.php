<?php

namespace App\Providers;

use App\Repositories\Contracts\TourRepositoryInterface;
use App\Repositories\TourRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
        *When we call our TourRepositoryInterface
        *Laravel will understand that we want to use
        *our TourRepository indeed
         */
        $this->app->bind(
            TourRepositoryInterface::class,
            TourRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
