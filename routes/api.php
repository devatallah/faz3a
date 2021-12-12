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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('forgot_password', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->middleware('auth:api');
    });

    Route::get('index', 'HomeController@index');
    Route::get('products', 'HomeController@products');
    Route::get('products/{id}', 'HomeController@product');
    Route::get('offers', 'HomeController@offers');
    Route::get('sliders', 'HomeController@sliders');
    Route::get('categories', 'HomeController@categories');
    Route::get('merchants', 'HomeController@merchants');
    Route::get('merchants/{id}', 'HomeController@merchant');
    Route::get('app_details', 'HomeController@appDetails');
    Route::get('ad', 'HomeController@ad');
    Route::post('send_message', 'HomeController@sendMessage');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('notifications', 'HomeController@notifications');
        Route::get('favorites', 'HomeController@favorites');
        Route::post('favorites', 'HomeController@favorite');
        Route::post('add_address', 'ProfileController@addAddress');
        Route::post('update_address', 'ProfileController@updateAddress');
        Route::post('delete_address', 'ProfileController@deleteAddress');
        Route::get('addresses', 'ProfileController@addresses');
        Route::post('add_cart', 'HomeController@addCart');
        Route::post('update_cart', 'HomeController@updateCart');
        Route::post('delete_cart', 'HomeController@deleteCart');
        Route::get('my_cart', 'HomeController@myCart');
        Route::post('check_out', 'HomeController@checkOut');
        Route::get('orders', 'HomeController@orders');
        Route::post('rating', 'HomeController@rating');
        Route::get('profile', 'ProfileController@profile');
        Route::post('update_profile', 'ProfileController@update');
        Route::post('update_password', 'ProfileController@updatePassword');
    });

});*/
