<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('logout', 'AuthController@logout');

    Route::get('dashboard', 'DashboardController@dashboard');

    # Users Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('dataindex', 'UsersController@dataindex');
        Route::get('deleted','UsersController@deleted');
        Route::get('datadeleted', 'UsersController@datadeleted');
        Route::get('{id}/restore','UsersController@restore');
    });
    Route::resource('users', 'UsersController');

    # Companies Management
    Route::group(array('prefix' => 'companies'), function () {
        Route::get('dataindex', 'CompaniesController@dataindex');
        Route::get('deleted','CompaniesController@deleted');
        Route::get('datadeleted', 'CompaniesController@datadeleted');
        Route::get('{id}/restore','CompaniesController@restore');
    });
    Route::resource('companies', 'CompaniesController');
});
