<?php

namespace App\Providers;


use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
        // Load settings globally
    $settings = \DB::table('settings')->first();

    // Share with all views
    view()->share('settings', $settings);
    }
}
