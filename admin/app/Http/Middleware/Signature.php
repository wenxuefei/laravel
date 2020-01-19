<?php

namespace App\Http\Middleware;

use Closure;

class Signature
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->except('signature','file');
        $signature = $this->makeSignature($data);

        if ($request->signature != $signature) {
            return api_response(config('responseCode.106'), 106,[$request->all(),$signature]);
        }

        return $next($request);
    }

    public function makeSignature($data)
    {
        ksort($data);
        $arr_str = '';
        foreach ($data as $key => $val) {
            $arr_str .= ($arr_str ? '&' : '') . $key . '=' . urlencode($val);
        }

        $arr_sha1 = hash('SHA1', $arr_str);

        $arr_sha1 = $arr_sha1 . config('app.appSecret');

        return md5($arr_sha1);
    }
}
