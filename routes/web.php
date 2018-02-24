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


/*  Account Controller Routes  */

Route::get('/', 'AccountController@accounts_overview');

Route::get('/accounts/confirm', 'AccountController@confirm');

Route::get('/accounts/setup', 'AccountController@setup');

Route::get('/accounts/activate', 'AccountController@activate');

Route::get('/accounts/deactivate', 'AccountController@cancellation');

Route::get('/accounts/mass-update', 'AccountController@mass_update');

Route::post('/accounts/confirm', 'AccountController@store');

Route::post('/accounts/activate', 'AccountController@update');

Route::post('/accounts/setup', 'AccountController@update');

Route::post('/accounts/deactivate', 'AccountController@deactivate');

/*  Service Controller Routes  */

Route::get('/services', 'ServiceController@service_overview');

Route::get('/services/create', 'ServiceController@create');

Route::post('/services/create', 'ServiceController@store');
