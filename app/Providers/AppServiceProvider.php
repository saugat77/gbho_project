<?php

namespace App\Providers;

use App\Category;
use App\Observers\CategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
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
      // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Order::observe(OrderObserver::class);

        // Overwite default OG image configuration
        // Config::set('seotools.opengraph.defaults.images', [siteLogoUrl()]);

        Blade::if('mobile', function () {
            return is_mobile();
        });

        Blade::if('desktop', function () {
            return is_desktop();
        });
    }
}
