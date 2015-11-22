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

Route::get('/login', 'Auth\AuthController@getLogin');
# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@getLogout');
# Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');
# Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');


Route::get('/', 'WheatonController@getIndex');

//Route::group(['middleware' => 'auth'], function() {
  Route::get('/add', 'WheatonController@getAdd');
  Route::post('/add', 'WheatonController@postAdd');
  Route::get('/edit', 'WheatonController@getEdit');
  Route::post('/edit', 'WheatonController@postEdit');
//});


Route::get('/search', 'WheatonController@getSearch');
Route::post('/search', 'WheatonController@postSearch');

Route::get('/test1', 'TestController@testScrape');
