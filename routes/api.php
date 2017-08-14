<?php

use Illuminate\Http\Request;

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


Route::group(['namespace' => 'API\V1', 'prefix' => 'v1', 'middleware' => 'guest'], function () {

    Route::post('/register', 'LoginController@register');
    Route::post('/login', 'LoginController@login');

});

Route::group(
    [
        'namespace' => 'API\V1', 
        'prefix' => 'v1',
        'middleware' => 'auth:api',
    ], function () {

        Route::get('/user', 'UserController@index');

    }
);