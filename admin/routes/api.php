<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app("Dingo\Api\Routing\Router");

$api->version('v1', function ($api) {

    $api->group(["namespace" => "App\Http\Controllers\Api\Admin", 'middleware' => ['signature']], function ($api) {

        $api->post('/login', 'LoginController@login')->name('login');
        $api->post('/upload', 'HomeController@upload');
        $api->group(['middleware' => ['auth:admins']], function ($api) {
            $api->post('/userInfo', 'HomeController@getUserInfo');
            $api->post('/getUserList', 'PermissionController@userList');
            $api->post('/addUser', 'PermissionController@addUser');

        });

    });


});

