<?php

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
});*/

//Route::group(['namespace' => 'Api'], function () {

Route::group(['namespace' => 'Auth'], function () {
    Route::post('register', 'RegisterController@register');
    Route::post('new_register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->middleware('auth:api');
});
Route::post('forgot_password', 'ProfileController@forgotPassword');
Route::post('send_code', 'ProfileController@sendCode');
Route::post('verify_code', 'ProfileController@verifyCode');
Route::post('reset_password', 'ProfileController@resetPassword');

Route::get('trip_types', 'HomeController@tripTypes');
Route::get('services', 'HomeController@services');
Route::get('vehicle_types', 'HomeController@vehicleTypes');
Route::get('drivers', 'HomeController@drivers');
Route::get('app_details', 'HomeController@appDetails');

Route::group(['middleware' => ['auth:user_api', 'verified:api.verification.notice']], function () {
    Route::get('trips', 'HomeController@trips');
    Route::post('accept_trip', 'HomeController@acceptTrip');
    Route::post('reject_trip', 'HomeController@rejectTrip');
    Route::post('cancel_trip', 'HomeController@cancelTrip');
    Route::post('confirm_trip', 'HomeController@confirmTrip');
    Route::get('notifications', 'HomeController@notifications');
    Route::post('rating', 'HomeController@rating');
    Route::get('profile', 'ProfileController@profile');
    Route::get('ratings', 'HomeController@ratings');
    Route::post('update_profile', 'ProfileController@update');
    Route::post('update_password', 'ProfileController@updatePassword');
    Route::post('send_complaint', 'HomeController@sendMessage');
    Route::get('get_driver/{id}', 'HomeController@getDriver');
});

//});
