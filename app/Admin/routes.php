<?php

use Illuminate\Routing\Router;

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
    $router->resource('locals', LocalController::class);
    $router->resource('inputs', InputController::class);
    $router->resource('outputs', OutputController::class);
    $router->resource('subusers', SubuserController::class);
    $router->get('reports', 'ReportController@index'::class);
    $router->get('reports/inputs', 'ReportController@exportInputs'::class)->name('exports.inputs');
    $router->get('reports/outputs', 'ReportController@exportOutputs'::class)->name('exports.outputs');
});
