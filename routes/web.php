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

Auth::routes();

Route::get('/', 'ShopController@index');
Route::get('/detail/{id}', 'ShopController@showDetail');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/mycart', 'ShopController@myCart')->middleware('auth');
    Route::post('/mycart', 'ShopController@addMyCart');
    Route::post('/cartdelete', 'ShopController@deleteCart');
    Route::post('/checkout', 'ShopController@checkout');
    Route::post('/detail/{id}', 'ShopController@addMyCart');
});

Route::get('login/twitter', 'Auth\TwitterLoginController@redirectToProvider');
Route::get('login/twitter/callback', 'Auth\TwitterLoginController@handleProviderCallback');
