<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\bookeey;
use App\Driver;
use App\Models\Service;
use App\Models\TripType;
use Carbon\Carbon;
use Cassandra\Uuid;
use Illuminate\Support\Facades\Route;

Route::post('/user/password/reset', 'Auth\ResetPasswordController@reset')->name('user.password.reset');

Route::get('admin/get_users', 'Admin\Auth\LoginController@getUsers')->name('get_users');


Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('login_admin');
    Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin_login');
    Route::post('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin_logout');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
        Route::get('chat', 'Admin\HomeController@chat')->name('chat');
        Route::get('home', 'Admin\HomeController@home')->name('home');

        Route::get('/', function () {
            return redirect('admin/home');
        });

        Route::get('/profile', function () {
            return view('admin.profile');
        });

        Route::put('/profile', 'ProfileController@update');

        Route::put('/password', 'ProfileController@changePassword');

        Route::group(['prefix' => 'categories', /*'middleware' => ['permission:categories']*/], function () {
            Route::get('/', 'CategoryController@index');
            Route::get('/create', 'CategoryController@create');
            Route::post('/', 'CategoryController@store');
            Route::get('/{id}/edit', 'CategoryController@edit');
            Route::put('/update_status', 'CategoryController@updateStatus');
            Route::put('/{id}', 'CategoryController@update');
            Route::delete('/{id}', 'CategoryController@destroy');
            Route::get('/indexTable', 'CategoryController@indexTable');
        });
        Route::group(['prefix' => 'cities', /*'middleware' => ['permission:cities']*/], function () {
            Route::get('/', 'CityController@index');
            Route::get('/create', 'CityController@create');
            Route::post('/', 'CityController@store');
            Route::get('/{id}/edit', 'CityController@edit');
            Route::put('/update_status', 'CityController@updateStatus');
            Route::put('/{id}', 'CityController@update');
            Route::delete('/{id}', 'CityController@destroy');
            Route::get('/indexTable', 'CityController@indexTable');
        });
        Route::group(['prefix' => 'countries', /*'middleware' => ['permission:countries']*/], function () {
            Route::get('/', 'CountryController@index');
            Route::get('/create', 'CountryController@create');
            Route::post('/', 'CountryController@store');
            Route::get('/{id}/edit', 'CountryController@edit');
            Route::put('/update_status', 'CountryController@updateStatus');
            Route::put('/{id}', 'CountryController@update');
            Route::delete('/{id}', 'CountryController@destroy');
            Route::get('/indexTable', 'CountryController@indexTable');
        });


        Route::group(['prefix' => 'drivers', /*'middleware' => ['permission:drivers']*/], function () {
            Route::get('/', 'DriverController@index');
            Route::get('/create', 'DriverController@create');
            Route::post('/', 'DriverController@store');
            Route::get('/{id}/edit', 'DriverController@edit');
            Route::put('/update_status', 'DriverController@updateStatus');
            Route::put('/{id}', 'DriverController@update');
            Route::delete('/{id}', 'DriverController@destroy');
            Route::get('/indexTable', 'DriverController@indexTable');
            Route::get('/track', 'DriverController@track');
            Route::get('/{id}', 'DriverController@show');
        });
        Route::group(['prefix' => 'users', /*'middleware' => ['permission:users']*/], function () {
            Route::get('/', 'UserController@index');
            Route::get('/create', 'UserController@create');
            Route::post('/', 'UserController@store');
            Route::get('/{id}/edit', 'UserController@edit');
            Route::put('/update_status', 'UserController@updateStatus');
            Route::put('/{id}', 'UserController@update');
            Route::delete('/{id}', 'UserController@destroy');
            Route::get('/indexTable', 'UserController@indexTable');
            Route::get('/{id}', 'UserController@show');
        });
        Route::group(['prefix' => 'trips', /*'middleware' => ['permission:trips']*/], function () {
            Route::get('/', 'TripController@index');
            Route::get('/indexTable', 'TripController@indexTable');
            Route::get('/{id}', 'TripController@show');
        });
        Route::group(['prefix' => 'plans', /*'middleware' => ['permission:plans']*/], function () {
            Route::get('/', 'PlanController@index');
            Route::get('/create', 'PlanController@create');
            Route::post('/', 'PlanController@store');
            Route::get('/{id}/edit', 'PlanController@edit');
            Route::put('/update_status', 'PlanController@updateStatus');
            Route::put('/{id}', 'PlanController@update');
            Route::delete('/{id}', 'PlanController@destroy');
            Route::get('/indexTable', 'PlanController@indexTable');
        });
        Route::group(['prefix' => 'services', /*'middleware' => ['permission:services']*/], function () {
            Route::get('/', 'ServiceController@index');
            Route::get('/create', 'ServiceController@create');
            Route::post('/', 'ServiceController@store');
            Route::get('/{id}/edit', 'ServiceController@edit');
            Route::put('/update_status', 'ServiceController@updateStatus');
            Route::put('/{id}', 'ServiceController@update');
            Route::delete('/{id}', 'ServiceController@destroy');
            Route::get('/indexTable', 'ServiceController@indexTable');
        });
        Route::group(['prefix' => 'trip_types', /*'middleware' => ['permission:trip_types']*/], function () {
            Route::get('/', 'TripTypeController@index');
            Route::get('/create', 'TripTypeController@create');
            Route::post('/', 'TripTypeController@store');
            Route::get('/{id}/edit', 'TripTypeController@edit');
            Route::put('/update_status', 'TripTypeController@updateStatus');
            Route::put('/{id}', 'TripTypeController@update');
            Route::delete('/{id}', 'TripTypeController@destroy');
            Route::get('/indexTable', 'TripTypeController@indexTable');
        });
        Route::group(['prefix' => 'packages', /*'middleware' => ['permission:packages']*/], function () {
            Route::get('/', 'PackageController@index');
            Route::get('/create', 'PackageController@create');
            Route::post('/', 'PackageController@store');
            Route::get('/{id}/edit', 'PackageController@edit');
            Route::put('/update_status', 'PackageController@updateStatus');
            Route::put('/{id}', 'PackageController@update');
            Route::delete('/{id}', 'PackageController@destroy');
            Route::get('/indexTable', 'PackageController@indexTable');
        });
        Route::group(['prefix' => 'vehicle_types', /*'middleware' => ['permission:vehicle_types']*/], function () {
            Route::get('/', 'VehicleTypeController@index');
            Route::get('/create', 'VehicleTypeController@create');
            Route::post('/', 'VehicleTypeController@store');
            Route::get('/{id}/edit', 'VehicleTypeController@edit');
            Route::put('/update_status', 'VehicleTypeController@updateStatus');
            Route::put('/{id}', 'VehicleTypeController@update');
            Route::delete('/{id}', 'VehicleTypeController@destroy');
            Route::get('/indexTable', 'VehicleTypeController@indexTable');
        });

        Route::group(['prefix' => 'notifications', /*'middleware' => ['permission:notifications']*/], function () {
            Route::get('/', 'NotificationController@index');
            Route::get('/create', 'NotificationController@create');
            Route::post('/', 'NotificationController@store');
            Route::get('/{id}/edit', 'NotificationController@edit');
            Route::put('/update_status', 'NotificationController@updateStatus');
            Route::put('/{id}', 'NotificationController@update');
            Route::delete('/{id}', 'NotificationController@destroy');
            Route::get('/indexTable', 'NotificationController@indexTable');
        });

        Route::group(['prefix' => 'admins', /*'middleware' => ['permission:admins']*/], function () {
            Route::get('/', 'AdminController@index');
            Route::get('/create', 'AdminController@create');
            Route::post('/', 'AdminController@store');
            Route::get('/{id}/edit', 'AdminController@edit');
            Route::put('/update_status', 'AdminController@updateStatus');
            Route::put('/{id}', 'AdminController@update');
            Route::delete('/{id}', 'AdminController@destroy');
            Route::get('/indexTable', 'AdminController@indexTable');
        });

        Route::group(['prefix' => 'pages', /*'middleware' => ['permission:pages']*/], function () {
            Route::get('/', 'PageController@index');
            Route::get('/{id}/edit', 'PageController@edit');
            Route::put('/{id}', 'PageController@update');
            Route::get('/indexTable', 'PageController@indexTable');
        });

        Route::group(['prefix' => 'subscriptions', /*'middleware' => ['permission:subscriptions']*/], function () {
            Route::get('/', 'SubscriptionController@index');
            Route::get('/{id}/edit', 'SubscriptionController@edit');
            Route::put('/{id}', 'SubscriptionController@update');
            Route::get('/indexTable', 'SubscriptionController@indexTable');
        });

        Route::group(['prefix' => 'contact_messages', /*'middleware' => ['permission:contact_messages']*/], function () {
            Route::get('/indexTable', 'ContactMessageController@indexTable');
            Route::get('/', 'ContactMessageController@index');
            Route::get('/{id}', 'ContactMessageController@show');
            Route::delete('/{id}', 'ContactMessageController@destroy');
        });

        Route::group(['prefix' => 'settings', /*'middleware' => ['permission:settings']*/], function () {
            Route::get('/', 'SettingController@edit')->name('settings.');
            Route::put('/', 'SettingController@update')->name('settings.update');
        });


    });
});
