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

Route::get('/', 'ThreadController@index');
Route::post('/', 'ThreadController@store');
Route::delete('/{thread_id}', 'ThreadController@destroy');

Route::get('/{thread_id}', 'ResponseController@index');
Route::get('/{thread_id}/{id}', 'ResponseController@show');
Route::post('/{thread_id}', 'ResponseController@store');
Route::post('/{thread_id}/{id}', 'ResponseController@store');