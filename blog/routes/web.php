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

Route::get('/admin','AdminController@index');
Route::get('/user/add','UserController@add');
Route::post('/user/insert','UserController@insert');
Route::get('/user/index','UserController@index');
Route::get('/user/edit/{id}','UserController@edit');
Route::post('/user/update','UserController@update');
Route::get('/user/delete/{id}','UserController@delete');


Route::resource('category','CategoryController');

