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


//Route::name('auth.')->namespace('API')->group(function () {
//    Route::post('register', 'AuthController@create')->name('register');
//    Route::post('login', 'AuthController@login')->name('login');
//    Route::post('logout', 'AuthController@logout')->name('logout');
//    Route::get('me', 'AuthController@customer');
//});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace' => 'API'], function () {
    Route::get('provinces', 'AddressController@getProvinces');

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@create');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@customer');
        Route::apiResource('categories', 'CategoryController');
        Route::get('categories/{id}/services', 'CategoryController@getServices');
        Route::get('categories/{id}/products', 'CategoryController@getProducts');

        Route::apiResource('orders', 'OrderController');

        Route::apiResource('loans', 'LoanController');
    });

});




