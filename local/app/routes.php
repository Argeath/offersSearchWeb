<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::post('filter', "FilterController@doSetFilter");
Route::get('offers/newest', "OffersController@showNewest");

Route::get('car/{brand}', "ModelController@showBrand");
Route::get('car/{brand}/{model}', "ModelController@showModel");
Route::get('car/{brand}/{model}/{year}', "ModelController@showYear");

Route::get('login', "LoginController@showLogin");
Route::post('login', "LoginController@doLogin");
Route::get('logout', "LoginController@doLogout");

Route::get('/', array('before' => 'auth', 'uses' => "HomeController@showWelcome"));
