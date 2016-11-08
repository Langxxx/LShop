<?php

namespace App\Providers;

use App\Services\RBACRouteService;
use Illuminate\Support\ServiceProvider;

class RABCRouteProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('RBACRouteService', function() {
            return new RBACRouteService();
        });
    }
}
