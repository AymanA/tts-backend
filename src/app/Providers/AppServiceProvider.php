<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\HotelRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Repositories\ReviewRepository;
use App\Services\HotelService;
use App\Services\Interfaces\HotelServiceInterface;
use App\Services\ReviewService;
use App\Services\Interfaces\ReviewServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReviewServiceInterface::class, ReviewService::class);
        $this->app->bind(HotelServiceInterface::class, HotelService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
    }
}
