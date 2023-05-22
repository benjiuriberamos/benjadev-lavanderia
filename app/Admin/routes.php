<?php

use Illuminate\Routing\Router;
// use App\Admin\Controllers\BrandController;
// use App\Admin\Controllers\ProductController;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix').'.',
], function (Router $router) {

    //Dashboard
    $router->get('/', 'HomeController@index')->name('home');

    //Dashboard
    $router->resource('multiimagen', ProductController::class);

    //Core
    $router->resource('products', ProductController::class);
    $router->resource('providers', ProviderController::class);

    //Setting pages
    // $router->resource('settings', PageSettingsController::class);
    // $router->resource('home', PageHomeController::class);
    // $router->resource('about', PageAboutController::class);
    // $router->resource('contact', PageContactController::class);


});
