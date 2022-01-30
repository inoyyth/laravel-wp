<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Serivices\Woocommerce;

class WoocommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\Woocommerce', function ($app) {
            return new WooCommerce;
        });
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
