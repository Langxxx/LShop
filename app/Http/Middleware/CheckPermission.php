<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = auth('admin')->user();
        if ($admin->is_super) {
            return $next($request);
        }
//        dd(Route::currentRouteName());
        if (!$admin->can(Route::currentRouteName())) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'code' => 403,
                    'msg' => '您没有权限执行此操作'
                ]);
            }else {
                return view('admin/error')->withError('没有权限访问');
            }
        }

        return $next($request);
    }
}
