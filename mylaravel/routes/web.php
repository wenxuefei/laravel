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

Route::post('/test', function () {
    print_r($_POST);
    echo '11111111111111';
});

Route::get('/form', function () {
    return view('form');
});

Route::get('/cs', function () {
    var_dump(session('uid'));
    echo '登录成功页面';
})->middleware('login');

Route::get('/ss', ['middleware' => 'login', 'uses' => function () {

    echo '这里是网站的设置页面.....';
}]);

Route::get('/user/{id}', 'UserController@index')->where('id', "\d+");

Route::get('/admin/user/delete/{id}', ['as' => 'udelete', 'uses' => 'Admin\UserController@delete']);

//隐式控制器
Route::resource('article', 'ArticleController');

Route::get('/requestTest', 'UserController@requestTest');
Route::get('/upload', 'UserController@upload');
Route::post('/uploadFile', 'UserController@uploadFile');
Route::get('/old', 'UserController@old');
Route::get('/cookieDemo', 'UserController@cookieDemo');
Route::get('/flash', 'UserController@flash');
Route::get('/get_flash', 'UserController@get_flash');

Route::get('/response', 'UserController@response');
Route::get('/blade', 'UserController@blade');

Route::get('/page', 'UserController@page');
Route::get('/cart', 'UserController@cart');
Route::get('/layout', 'UserController@layout');
Route::get('/extend', 'UserController@extend');
Route::get('/liucheng', 'UserController@liucheng');

Route::get('/sql', 'UserController@sql');

Route::get('func','UserController@func');
Route::get('relation','UserController@relation');

