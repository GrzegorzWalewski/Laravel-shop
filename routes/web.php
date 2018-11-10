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
Route::get('/cart/increase/{cart}','CartsController@increase');

Route::get('/cart/decrease/{cart}','CartsController@decrease');

Route::get('/cart/del/{cart}','CartsController@del');

Route::get('/cart/add','CartsController@store');

Route::get('/cart','CartsController@show');

Route::get('/load', 'ProductsController@load');

Route::get('/sale','ProductsController@sale');

Route::get('/search/','ProductsController@search');

Auth::routes();

Route::get('/', 'ProductsController@index');

Route::get('/admin', 'ProductsController@adminPanel')->middleware('role');

Route::get('/{product}','ProductsController@show');

Route::get('/category/{category}','CategorysController@index');

//Products

Route::get('/products/add', 'ProductsController@create')->middleware('role');

Route::post('/products/store', 'ProductsController@store')->middleware('role');

Route::get('/products/edit/{product}', 'ProductsController@edit')->middleware('role');

Route::get('/products/del/{product}', 'ProductsController@del')->middleware('role');

//Categories

Route::get('/categories/add', 'CategorysController@create')->middleware('role');

Route::post('/categories/store', 'CategorysController@store')->middleware('role');

Route::get('/categories/del', 'CategorysController@show')->middleware('role');

Route::get('/categories/del/{category}', 'CategorysController@del')->middleware('role');

//Discounts

Route::get('/discounts/add', 'DiscountsController@create')->middleware('role');

Route::post('/discounts/store', 'DiscountsController@store')->middleware('role');

Route::get('/discounts/del', 'DiscountsController@show')->middleware('role');

Route::get('/discounts/del/{discount}', 'DiscountsController@del')->middleware('role');