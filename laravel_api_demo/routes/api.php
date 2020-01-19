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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Dingo api
 */
$api = app('Dingo\Api\Routing\Router');

$api->version(['v1', 'v2'], function ($api){});

$api->version('v1', function ($api){
	//每分钟限流60次
	$api->group(['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api){
		$api->get('jokes/{page?}', 'App\Api\V1\Controllers\JokeController@index')->where('page', '[1-9]\d*');
	});
});

$api->version('v2', function ($api){});
