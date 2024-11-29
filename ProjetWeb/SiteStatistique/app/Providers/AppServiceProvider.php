<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Request;

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
        RateLimiter::for('tentatives', function (Request $request) {
            return Limit::perMinute(5)->response(function (Request $request, array $headers) {
                return response('Tentative de connexion maximal atteinte.Veuillez patientez!', 429, $headers);
            });
        });
    }
}
