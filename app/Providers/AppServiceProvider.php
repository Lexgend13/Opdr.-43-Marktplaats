<?php

namespace App\Providers;
use Illuminate\Support\Facades\RateLimiter;

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
    public function boot()
    {
        // Disable all rate-limiting for testing purposes
        RateLimiter::for('reset-password', function () {
        return null;
    });
}
}
