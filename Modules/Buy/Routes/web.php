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

Route::prefix('buy')->group(function () {
    Route::post('store', 'BuyController@store')->name('admin.buy.users.store');
    Route::get('list', 'BuyController@list')->name('admin.buy.user.list');

});
