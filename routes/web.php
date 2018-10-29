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
Route::get('/sale','ProductsController@sale');

Auth::routes();

Route::get('/', 'ProductsController@index');

Route::get('/admin', 'ProductsController@index')->middleware('role');

Route::get('/{product}','ProductsController@show');

Route::get('/category/{category}','CategorysController@index');