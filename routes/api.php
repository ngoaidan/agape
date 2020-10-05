<?php

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
    Route::post('customers/update-password', 'AuthController@changePassword');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::post('customers/avatar', 'CustomerController@uploadAvatar');
        Route::get('customers/order/services', 'CustomerController@orderServices');
        Route::get('customers/order/products', 'CustomerController@orderProducts');
        Route::get('customers/cumulative-points', 'CustomerController@getCumulativePoints');
        Route::get('customers/cumulative-points/category/{idCategory}', 'CustomerController@getCumulativePointsItem');
        Route::apiResource('customers', 'CustomerController');
        Route::apiResource('enterprises', 'EnterpriseController');

        Route::get('categories/roots', 'CategoryController@getRoot');
        Route::get('categories/{id}/children', 'CategoryController@getChildren');
        Route::get('categories/{id}/services', 'CategoryController@getServices');
        Route::get('categories/{id}/products', 'CategoryController@getProducts');
        Route::get('categories/{id}/posts', 'CategoryController@getPosts');
        Route::apiResource('categories', 'CategoryController');

//        Route::apiResource('orders', 'OrderController');
        Route::post('orders/product', 'OrderController@store');
        Route::get('orders/product', 'OrderController@index');
        Route::post('orders/service', 'OrderServiceController@store');
        Route::get('orders/service', 'OrderServiceController@index');

        Route::apiResource('loans', 'LoanController');

        Route::post('/supports', 'SupportController@store');
    });

});




