<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','ArticlesController@index');

Route::get('articles/create','ArticlesController@create');

Route::get('articles','ArticlesController@index');

Route::get('articles/{articles}','ArticlesController@show');

Route::post('articles','ArticlesController@store');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index');
