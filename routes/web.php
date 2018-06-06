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

    return view('welcome',['date'=>date("Y/m/d")]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('setDepartment', [
    'uses' => 'UsersController@setDept'
]);

Route::post('placeOrder', [
    'uses' => 'UsersController@placeOrder'
]);

Route::post('changeOrder', [
    'uses' => 'UsersController@changeOrder'
]);

Route::post('cancelOrder', [
    'uses' => 'UsersController@cancelOrder'
]);

Route::get('/admin', 'HomeController@admin')->name('home');


Route::post('summary', [
    'uses' => 'HomeController@adminSummary'
]);
