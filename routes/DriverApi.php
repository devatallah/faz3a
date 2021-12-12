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

/*Route::middleware('auth:api')->get('/driver', function (Request $request) {
    return $request->driver();
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
Route::get('plans', 'HomeController@plans');
Route::get('app_details', 'HomeController@appDetails');
Route::get('send_message_notification', 'HomeController@sendMessageNotification');

Route::group(['middleware' => ['auth:driver_api', 'verified']], function () {
    Route::post('reorder', 'HomeController@reorder');
    Route::post('create_trip', 'HomeController@createTrip');
    Route::get('trips', 'HomeController@trips');
    Route::post('start_trip', 'HomeController@startTrip');
    Route::post('cancel_trip', 'HomeController@cancelTrip');
    Route::post('end_trip', 'HomeController@endTrip');
    Route::get('notifications', 'HomeController@notifications');
    Route::get('profile', 'ProfileController@profile');
    Route::get('ratings', 'HomeController@ratings');
    Route::post('update_profile', 'ProfileController@update');
    Route::post('update_vehicle', 'ProfileController@updateVehicle');
    Route::post('update_password', 'ProfileController@updatePassword');
    Route::get('get_user/{id}', 'HomeController@getUser');
    Route::post('send_complaint', 'HomeController@sendMessage');
    Route::post('subscribe', 'HomeController@subscribe');
    Route::get('subscriptions', 'HomeController@subscriptions');
    Route::post('rating', 'HomeController@rating');
    Route::post('change_status', 'HomeController@changStatus');
});

//});
