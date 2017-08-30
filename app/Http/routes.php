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
        Route::get('{id}/delete','UsersController@destroy');
    });
    Route::resource('users', 'UsersController');

    # Companies Management
    Route::group(array('prefix' => 'companies'), function () {
        Route::get('dataindex', 'CompaniesController@dataindex');
        Route::get('deleted','CompaniesController@deleted');
        Route::get('datadeleted', 'CompaniesController@datadeleted');
        Route::get('{id}/restore','CompaniesController@restore');
        Route::get('{id}/delete','CompaniesController@destroy');
    });
    Route::resource('companies', 'CompaniesController');

    Route::get('is-facturation/{id}', 'CompaniesController@isFacturation');

    # Directs Movements Management
    Route::group(array('prefix' => 'directs-movements'), function () {
        Route::get('dataindex', 'DirectsMovementsController@dataindex');
        Route::get('show-finished', 'DirectsMovementsController@showFinished');
        Route::get('datafinished', 'DirectsMovementsController@datafinished');
        Route::get('{id}/administrator-facturation','DirectsMovementsController@showAdministratorFacturation');
        Route::post('administrator-facturation','DirectsMovementsController@storeAdministrationFacturation');
        Route::get('{id}/banks-payment','DirectsMovementsController@showBanksPayment');
        Route::post('banks-payment','DirectsMovementsController@storeBanksPayment');
        Route::get('{id}/create-facturations','DirectsMovementsController@createFacturations');
        Route::post('create-facturations','DirectsMovementsController@storeFacturation');
        Route::get('{id}/create-facturations-invoices','DirectsMovementsController@createFacturationsInvoices');
        Route::post('create-facturations-invoices','DirectsMovementsController@storeFacturationInvoices');
        Route::get('{id}/facturations-payment','DirectsMovementsController@showFacturationsPayment');
        Route::post('facturations-payment','DirectsMovementsController@storeFacturationsPayment');
        Route::get('{id}/outputs-receipts','DirectsMovementsController@showOutputsReceipts');
        Route::post('outputs-receipts','DirectsMovementsController@storeOutputsReceipts');
        Route::get('{id}/facturations-rollback','DirectsMovementsController@facturationsRollback');
        Route::get('{id}/movement-rollback','DirectsMovementsController@movementRollback');
        Route::get('{id}/delete-payment-entry','DirectsMovementsController@deletePaymentEntry');
        Route::get('{id}/delete','DirectsMovementsController@destroy');
    });
    Route::resource('directs-movements', 'DirectsMovementsController');

    # Simples Movements Management
    Route::group(array('prefix' => 'simples-movements'), function () {
        Route::get('dataindex', 'SimplesMovementsController@dataindex');
        Route::get('show-finished', 'SimplesMovementsController@showFinished');
        Route::get('datafinished', 'SimplesMovementsController@datafinished');
        Route::get('{id}/administrator-facturation','SimplesMovementsController@showAdministratorFacturation');
        Route::post('administrator-facturation','SimplesMovementsController@storeAdministrationFacturation');
        Route::get('{id}/banks-payment','SimplesMovementsController@showBanksPayment');
        Route::post('banks-payment','SimplesMovementsController@storeBanksPayment');
        Route::get('{id}/create-facturations','SimplesMovementsController@createFacturations');
        Route::post('create-facturations','SimplesMovementsController@storeFacturation');
        Route::get('{id}/create-facturations-invoices','SimplesMovementsController@createFacturationsInvoices');
        Route::post('create-facturations-invoices','SimplesMovementsController@storeFacturationInvoices');
        Route::get('{id}/facturations-payment','SimplesMovementsController@showFacturationsPayment');
        Route::post('facturations-payment','SimplesMovementsController@storeFacturationsPayment');
        Route::get('{id}/outputs-receipts','SimplesMovementsController@showOutputsReceipts');
        Route::post('outputs-receipts','SimplesMovementsController@storeOutputsReceipts');
        Route::get('{id}/facturations-rollback','SimplesMovementsController@facturationsRollback');
        Route::get('{id}/movement-rollback','SimplesMovementsController@movementRollback');
        Route::get('{id}/delete-payment-entry','SimplesMovementsController@deletePaymentEntry');
        Route::get('{id}/delete','SimplesMovementsController@destroy');
    });
    Route::resource('simples-movements', 'SimplesMovementsController');

    # Payrolls Movements Management
    Route::group(array('prefix' => 'payrolls-movements'), function () {
        Route::get('dataindex', 'PayrollsMovementsController@dataindex');
        Route::get('show-finished', 'PayrollsMovementsController@showFinished');
        Route::get('datafinished', 'PayrollsMovementsController@datafinished');
        Route::get('{id}/administrator-facturation','PayrollsMovementsController@showAdministratorFacturation');
        Route::post('administrator-facturation','PayrollsMovementsController@storeAdministrationFacturation');
        Route::get('{id}/banks-payment','PayrollsMovementsController@showBanksPayment');
        Route::post('banks-payment','PayrollsMovementsController@storeBanksPayment');
        Route::get('{id}/create-facturations','PayrollsMovementsController@createFacturations');
        Route::post('create-facturations','PayrollsMovementsController@storeFacturation');
        Route::get('{id}/create-facturations-invoices','PayrollsMovementsController@createFacturationsInvoices');
        Route::post('create-facturations-invoices','PayrollsMovementsController@storeFacturationInvoices');
        Route::get('{id}/facturations-payment','PayrollsMovementsController@showFacturationsPayment');
        Route::post('facturations-payment','PayrollsMovementsController@storeFacturationsPayment');
        Route::get('{id}/outputs-receipts','PayrollsMovementsController@showOutputsReceipts');
        Route::post('outputs-receipts','PayrollsMovementsController@storeOutputsReceipts');
        Route::get('{id}/facturations-rollback','PayrollsMovementsController@facturationsRollback');
        Route::get('{id}/movement-rollback','PayrollsMovementsController@movementRollback');
        Route::get('{id}/delete-payment-entry','PayrollsMovementsController@deletePaymentEntry');
        Route::get('{id}/delete','PayrollsMovementsController@destroy');
    });
    Route::resource('payrolls-movements', 'PayrollsMovementsController');

    # Lendings Management
    Route::group(array('prefix' => 'lendings'), function () {
        Route::get('dataindex', 'LendingsController@dataindex');
        Route::get('show-finished', 'LendingsController@showFinished');
        Route::get('datafinished', 'LendingsController@datafinished');
        Route::get('{id}/banks-payment','LendingsController@showBanksPayment');
        Route::post('banks-payment','LendingsController@storeBanksPayment');
        Route::get('{id}/banks-receipt','LendingsController@showBanksReceipt');
        Route::post('banks-receipt','LendingsController@storeBanksReceipt');
        Route::get('{id}/movement-rollback','LendingsController@movementRollback');
        Route::get('{id}/delete','LendingsController@destroy');
    });
    Route::resource('lendings', 'LendingsController');
});
