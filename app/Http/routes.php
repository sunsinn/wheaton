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

Route::get('/', 'WheatonController@getIndex');
Route::get('/addrecipes', 'WheatonController@getAdd');
Route::post('/addrecipes', 'WheatonController@postAdd');
Route::get('/findrecipes', 'WheatonController@getFind');
Route::post('/findrecipes', 'WheatonController@postFind');
Route::get('/editrecipes', 'WheatonController@getEdit');
Route::post('/editrecipes', 'WheatonController@postEdit');
