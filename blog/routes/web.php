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


Route::get('/', 'ArticleController@lists');

//登陆的页面显示
Route::get('/login', 'LoginController@login');
Route::post('/login','LoginController@dologin');
Route::get('/logout', 'LoginController@logout');

//文章的详情显示页面
Route::get('/article/{id}.html', [
    'uses'=>'ArticleController@show',
    'as'=>'detail'
]);

Route::get('/articles', 'ArticleController@lists');

//后台路由组
Route::group(['middleware'=>'login'], function(){

    Route::get('/admin','AdminController@index');
    Route::get('/user/add','UserController@add');
    Route::post('/user/insert','UserController@insert');
    Route::get('/user/index','UserController@index');
    Route::get('/user/edit/{id}','UserController@edit');
    Route::post('/user/update','UserController@update');
    Route::get('/user/delete/{id}','UserController@delete');

    //resful 控制器  一条规则顶七条
    Route::resource('category','CategoryController');

    //标签管理
    Route::resource('tag','TagController');

    //文章管理
    Route::resource('article','ArticleController');

});











