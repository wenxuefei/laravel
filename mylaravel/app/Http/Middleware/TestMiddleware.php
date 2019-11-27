<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
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
        $path = $request->path();
        $ip = $request->ip();

        $res = $path . ' ----------------------' . $ip . '-------------------' . date('Y-m-d H:i');
        $res .= "\n\n";

        file_put_contents('request.log', $res, FILE_APPEND);
        return $next($request);
    }
}
