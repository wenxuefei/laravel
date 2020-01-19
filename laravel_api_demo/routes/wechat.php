<?php

/*
|--------------------------------------------------------------------------
| Wechat Routes
|--------------------------------------------------------------------------
| App\Providers\RouteServiceProvider mapWechatRoutes()注册
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('wechat', ['prefix' => 'api/wechat'], function ($api){
	//小程序分组，限流60次/1分钟
	$api->group([
		'middleware' => 'api.throttle',
		'limit' => 60, 'expires' => 1,
		'prefix' => 'mina',
		'namespace' => 'App\Api\Wechat\Mina\Controllers'
	], function ($api){
		$api->post('mina_login', 'LoginController@minaLogin');
		$api->get('user/me', 'UserController@me');
	});
	//公众号
});