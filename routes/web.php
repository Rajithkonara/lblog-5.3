<?php

use Illuminate\Support\Facades\Redis;




Route::get('/','ArticlesController@index');

Route::get('articles/create','ArticlesController@create');

Route::get('articles','ArticlesController@index');

Route::get('articles/{articles}','ArticlesController@show');

Route::get('articles/edit/{articles}','ArticlesController@edit');

Route::post('articles/edit/{articles}','ArticlesController@update');

Route::post('articles','ArticlesController@store');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('amp','ArticlesController@apm');

