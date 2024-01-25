<?php

namespace App\Providers;

use App\Services\GeocodingService;
use App\Services\StoreFileService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('GeocodingService', function ($app) {
            return new GeocodingService();
        });

        $this->app->singleton('StoreFileService', function ($app) {
            return new StoreFileService();
        });

    }
}
