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

use Illuminate\Support\Facades\Route;

Route::namespace('Home')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('article/search', 'ArticleController@search');
    Route::get('article/test', 'ArticleController@test');
    Route::resource('article', 'ArticleController');
    Route::post('article/image/upload', 'ArticleController@upload');
    Route::post('article/{id}/comment', 'ArticleController@comment');
    Route::get('article/{id}/zan', 'ArticleController@zan');
    Route::get('article/{id}/unzan', 'ArticleController@unzan');

    Route::get('register', 'RegisterController@index');
    Route::post('register', 'RegisterController@register');
    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('user/setting', 'UserController@setting');
    Route::post('user/setting', 'UserController@settingStore');
    Route::get('user/{id}', 'UserController@show');

    Route::post('user/{id}/fan', 'UserController@fan');
    Route::post('user/{id}/unfan', 'UserController@unFan');

    Route::get('topic/{topic}', 'TopicController@show');
    Route::post('topic/{topic}/submit', 'TopicController@submit');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');

    Route::group(['middleware' => 'auth:admin'],function (){
        Route::get('/', 'HomeController@index');
    });

});
