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

Route::get('/','HomeController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth']],function ($router){
    Route::get('/', 'HomeController@index')->name('admin');
    Route::resource('menu','MenuController');
    Route::get('permission/ajaxIndex','PermissionController@ajaxIndex')->name('permission.ajaxIndex');
    Route::resource('permission','PermissionController');


});
