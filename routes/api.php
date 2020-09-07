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

Route::apiResource('categories', 'API\CategoryController');

Route::get('categories/{id}/services', 'API\CategoryController@getServices');


//Route::name('auth.')->namespace('API')->group(function () {
//    Route::post('register', 'AuthController@create')->name('register');
//    Route::post('login', 'AuthController@login')->name('login');
//    Route::post('logout', 'AuthController@logout')->name('login');
//});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'name' => 'auth.',
    'namespace' => 'API',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@customer');
    });
});
