<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\GlobalDataComposer;

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
        // view()->share('header_categories', 'Hola, mundo!');
        // view()->share('footer_categories', 'Hola, mundo!');
        // view()->share('info', 'Hola, mundo!');
        view()->composer('front.*', GlobalDataComposer::class);
        // view()->composer('front.home', GlobalDataComposer::class);
        // view()->composer('front.home', GlobalDataComposer::class);
        // view()->composer('front.template._base', GlobalDataComposer::class);
        //
    }
}
