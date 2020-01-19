<?php

namespace App\Api\Wechat\Mina\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    use Helpers;

    const APPID = 'wx75882c29cb6f24fe';
    const APPSECRET = '0cc0c604e03975fc620dbf2be4b3372f';
}
