<?php

namespace App\Providers;

use App\Services\Contracts\RequestFilterInterface;
use App\Services\Contracts\VacantionInterface;
use App\Services\RequestFilterService;
use App\Services\VacantionService;
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
        $this->app->singleton(VacantionInterface::class, VacantionService::class);
        $this->app->singleton(RequestFilterInterface::class, RequestFilterService::class);
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
