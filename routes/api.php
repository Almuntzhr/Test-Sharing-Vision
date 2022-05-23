<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**
 * route posts
 */
Route::get('posts/{limit}/{offset}', 'PostController@index');
Route::post('posts', 'PostController@store');
Route::get('posts/{id}', 'PostController@show');
Route::put('posts/{id}', 'PostController@update');
Route::delete('posts/{id}', 'PostController@destroy');