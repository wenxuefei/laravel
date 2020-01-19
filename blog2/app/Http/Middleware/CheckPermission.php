<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        $routeName = 'admin.'.Route::currentRouteName();
//        dd($routeName);
        $permission = '';

        switch ($routeName) {
            case 'admin.' . $model . '.index':
            case 'admin.' . $model . '.ajaxIndex':

                $permission = 'admin.' . $model . 's.list';

                break;
            case 'admin.' . $model . '.create':
            case 'admin.' . $model . '.store':
                $permission = 'admin.' . $model . 's.create';
                break;
            case 'admin.' . $model . '.edit':
            case 'admin.' . $model . '.update':
                $permission = 'admin.' . $model . 's.edit';
                break;
            default:
                $permission = 'admin.' . $model.'s';
        }

        if (!$request->user()->can($permission)) {
            abort(511,'你没有操作权限');
        }

        return $next($request);
    }
}
