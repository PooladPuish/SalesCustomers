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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ارسال مشخصات نمایندگان فروشی که تایید نشده اند


Route::group(['namespace' => 'Api'], function () {

    Route::get('SalesCustomers', 'UserController@SalesCustomers');
    Route::get('api', 'UserController@api');
    Route::get('buy', 'UserController@buy');

});

//
//Route::get('SalesCustomers', function () {
//    $salescustomers = \App\User::whereNull('success')->get();
//    return response()->json($salescustomers);
//});
