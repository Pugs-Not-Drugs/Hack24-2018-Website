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

Route::get('/', 'DashboardController@index');

Route::get('/straws', 'StrawsController@index');
Route::match(['get', 'post'], '/straws/report', 'StrawsController@report');

Route::get('/ajax/companies/search', 'StrawsController@searchCompanies');