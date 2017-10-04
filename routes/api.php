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



// Routes that don't require authentication
Route::group(
    [
        'namespace' => 'API\V1', 
        'prefix' => 'v1', 
        'middleware' => 'guest'
    ], function () {

        Route::post('/register', 'LoginController@register');
        Route::post('/login', 'LoginController@login')->name('login');

    }
);

// Routes that do require authentication
Route::group(
    [
        'namespace' => 'API\V1', 
        'prefix' => 'v1',
        'middleware' => 'auth:api',
    ], function () {

        Route::get('/user', 'UserController@index');

        Route::get('/recipe', 'RecipeController@index');
        Route::post('/recipe', 'RecipeController@create');
        Route::put('/recipe/{recipe}', 'RecipeController@update');
        Route::delete('/recipe/{recipe}', 'RecipeController@destroy');

        Route::get('/ingredient', 'IngredientController@index');

    }
);
