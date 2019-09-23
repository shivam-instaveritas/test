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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api', 'namespace' => 'user'], function () {
    Route::get('/users/create', 'UserController@create');
    Route::post('/users', 'UserController@store');


    Route::group(['middleware' => ['auth']], function () {
        Route::get('/users', 'UserController@index');
        Route::get('/users/{id}', 'UserController@show')->middleware('age');
        Route::put('/users/{id}', 'UserController@update');
        Route::delete('/users/id', 'UserController@destroy');
        });
});
