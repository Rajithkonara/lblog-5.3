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

Route::get('articles/{id}','ArticlesController@show');

Route::post('articles','ArticlesController@store');

Auth::routes();

Route::get('/home', 'HomeController@index');
