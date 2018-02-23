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

/*  Service Controller Routes  */

Route::get('/services', 'ServiceController@service_overview');

Route::get('/services/create', 'ServiceController@create');

Route::post('/services/create', 'ServiceController@store');
