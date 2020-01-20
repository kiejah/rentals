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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/property-units', 'UnitsController@propertyUnits')->name('property-units');

Route::get('/properties/print', 'PropertiesController@printExcel')->name('print-excel-properties');
Route::get('/properties/printunits/{id}', ['uses' =>'PropertiesController@printUnits', 'as'=>'printunits']);
Route::get('/properties/addunit/{id}','PropertiesController@addUnit')->name('add-unit');
Route::get('/properties/addtenant/{id}','PropertiesController@addTenant')->name('add-tenant');
Route::resource('properties', 'PropertiesController');

Route::get('/units/vacant','UnitsController@showVacant')->name('vacant-units');
Route::get('/units/occupied','UnitsController@showOccupied')->name('occupied-units');
Route::get('/units/addtenant/{id}','UnitsController@addTenant')->name('add-unit-tenant');
Route::resource('units', 'UnitsController');


Route::resource('tenants', 'TenantsController');

Route::get('/accounts/print', 'TenantAccountsController@printExcel')->name('print-excel');
Route::resource('accounts', 'TenantAccountsController');

Route::post('/unit-rentCharge', 'UnitsController@unitRent')->name('unit-rentCharge');
