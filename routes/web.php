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

Route::get('/{thread_name}', 'ResponseController@index');
Route::get('/{thread_name}/{id}', 'ResponseController@show');
Route::post('/{thread_name}', 'ResponseController@store');
Route::post('/{thread_name}/{id}', 'ResponseController@store');