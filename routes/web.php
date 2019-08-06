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
Route::get('/simple', ['uses' => 'SimpleController@index']);
Route::get('/simple/create', ['uses' => 'SimpleController@create']);
Route::post('/simple/create', ['uses' => 'SimpleController@create']);

Route::get('/simple/edit/{id}', ['uses' => 'SimpleController@edit']);
Route::post('/simple/edit/{id}', ['uses' => 'SimpleController@edit']);

Route::get('/simple/delete/{id}', ['uses' => 'SimpleController@delete']);
Route::get('/simple/paginate', ['uses' => 'SimpleController@paginate']);