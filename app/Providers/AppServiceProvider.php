<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Library\Services\Woocommerce;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $woocommerce = new Woocommerce();
        $category = $woocommerce->get('products/categories');
        $menu = json_decode(Http::get(config('app.wp_api_inoy') . 'menu?slug=main-menu')->body());
        $view = array(
            'main_menu' => $menu,
            'product_categories' => $category
        );
        View::share('view_share', $view);
    }
}
