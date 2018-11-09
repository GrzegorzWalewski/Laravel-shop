<?php

namespace Shop\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.nav', function($view){
            $view->with('categories',\Shop\Category::get());
        });

        view()->composer('layouts.nav', function($view){
            $view->with('cart',\Shop\Cart::countWithPieces());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
