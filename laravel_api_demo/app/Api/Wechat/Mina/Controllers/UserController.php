<?php

namespace App\Api\Wechat\Mina\Controllers;


class UserController extends BaseController
{
	public function __construct()
	{
		$this->middleware('auth:wechat');
	}

	public function me()
	{
		return auth('wechat')->user();
	}
}
