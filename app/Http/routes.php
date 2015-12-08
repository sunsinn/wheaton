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

Route::group(['middleware' => 'auth'], function() {
  Route::get('/add', 'WheatonController@getAdd');
  Route::post('/add', 'WheatonController@postAdd');
  Route::get('/ingredients/{id?}', 'WheatonController@getIngredients');
  Route::get('/edit/{id?}', 'WheatonController@getEdit');
  Route::post('/edit/{id?}', 'WheatonController@postEdit');
  Route::post('/delete', 'WheatonController@delete');
  Route::get('/browsemyrecipes', 'WheatonController@browseMyRecipes');
});


Route::get('/search', 'WheatonController@getSearch');
Route::post('/search', 'WheatonController@postSearch');


Route::get('/browserecipes', 'WheatonController@browseRecipes');
Route::get('/browseingredients', 'WheatonController@browseIngredients');


Route::get('/show/{id}', 'WheatonController@show');
Route::get('/showrecipes/{if}', 'WheatonController@showRecipes');

Route::get('/populate', 'IngredientsController@populate');

Route::get('/test1', 'TestController@testScrape');
Route::get('/test2', 'TestController@testScrape2');
