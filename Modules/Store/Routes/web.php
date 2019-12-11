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

Route::prefix('store')->group(function() {
    Route::get('list', 'StoreController@list')->name('admin.store.user.list');
    Route::get('wizard/{id?}', 'StoreController@wizard')->name('admin.store.user.wizard');
});
