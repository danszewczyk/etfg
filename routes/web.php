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



Route::get('/import_test', 'ImportController@index');
Route::get('/import_data', 'ImportController@PortfolioPDF');




Route::get('/home', 'IndexController@index')->name('homepage.index');

Route::get('/test', 'TestingController@update_views')->name('testing');

Route::get('/product', 'ProductController@index_new')->name('product.index');
Route::get('/product/{id}', 'ProductController@show')->name('product.show');

Route::get('/issuer', 'IssuerController@index')->name('issuer.index');
Route::get('/issuer/{id}', 'IssuerController@show')->name('issuer.show');

Route::get('/asset_class', 'AssetClassController@index')->name('assetClass.index');
Route::get('/asset_class/{id}', 'AssetClassController@show')->name('assetClass.show');

Route::get('/firm', 'FirmController@index')->name('firm.index');
Route::get('/firm/{id}', 'FirmController@show')->name('firm.show');

Route::get('/country', 'CountryController@index')->name('country.index');
Route::get('/country/{id}', 'CountryController@show')->name('country.show');


Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/{id}', 'CategoryController@show')->name('categoryShow');


Route::get('/domain', 'DataController@firm_domain_lookup')->name('firm_domain_lookup');

Route::post('/domain', 'DataController@firm_domain_lookupPost')->name('firm_domain_lookupPost');

Route::get('/search', 'SearchController@show')->name('search.show');

