<?php

namespace App\Api\Wechat\Mina\Controllers;

use App\Api\Wechat\Mina\Models\User;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class LoginController extends BaseController
{
	public function __construct()
	{

	}
	public function minaLogin(Request $request)
	{
		$code = $request->post('code', '');
		$encryptedData = $request->post('encryptedData', '');
		$iv = $request->post('iv', '');
		$session = $this->__code2session($code);
		$userInfo = $this->__getUserInfo($encryptedData, $iv, $session['session_key']);
		$user = $this->__createOrUpdateUserInfo($userInfo);
		$token = auth('wechat')->login($user);
		return $this->respondWithToken($token);
    }

	private function __code2session( $code )
	{
		$url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.self::APPID.'&secret='.self::APPSECRET.'&js_code='.$code.'&grant_type=authorization_code';
		$result = Curl::to($url)->get();
		return json_decode($result, true);
    }

	private function __getUserInfo($encryptedData, $iv, $session_key)
	{
		$pc = new \WXBizDataCrypt(self::APPID, $session_key);
		$err_code = $pc->decryptData($encryptedData, $iv, $data);
		if ($err_code == 0) return json_decode($data, true);
    }

	private function __createOrUpdateUserInfo($userInfo)
	{
		unset($userInfo['watermark']);
		return User::query()->updateOrCreate(['openId' => $userInfo['openId']], $userInfo);
    }

	protected function respondWithToken($token)
	{
		return $this->response()->array([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth('wechat')->factory()->getTTL() * 60
		]);
	}
}
