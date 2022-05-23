<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->put('/posts/trash/{id}', 'PostController@trash')->name('trash');
    $router->resource('preview', PreviewController::class);
    $router->resource('posts', PostController::class);

});
