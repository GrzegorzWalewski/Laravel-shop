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

Route::get('/admin', 'ProductsController@adminPanel')->middleware('role');

Route::get('/{product}','ProductsController@show');

Route::get('/category/{category}','CategorysController@index');

//Products

Route::get('/products/add', 'ProductsController@create')->middleware('role');

Route::get('/products/store', 'ProductsController@store')->middleware('role');

Route::get('/products/edit', 'ProductsController@edit')->middleware('role');

Route::get('/products/del', 'ProductsController@del')->middleware('role');

//Categories

Route::get('/categories/add', 'CategorysController@create')->middleware('role');

Route::get('/categories/store', 'CategorysController@store')->middleware('role');

Route::get('/categories/edit', 'CategorysController@edit')->middleware('role');

Route::get('/categories/del', 'CategorysController@del')->middleware('role');

//Discounts

Route::get('/discounts/add', 'DiscountsController@create')->middleware('role');

Route::get('/discounts/store', 'DiscountsController@store')->middleware('role');

Route::get('/discounts/edit', 'DiscountsController@edit')->middleware('role');

Route::get('/discounts/del', 'DiscountsController@del')->middleware('role');