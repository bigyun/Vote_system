<?php

namespace App\Http\Middleware;

use Closure;

class isBuyerMiddleware
{
    /**
     * 买家中间件 验证登录用户是否为买家
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session_id = $request->cookie('session_id');
        $userInfo = $request->session()->get($session_id);
        if($userInfo['userType'] != 1){
            $resData = config('app.resData.err403');
            $resData['msg'] = '访问错误，无买家权限';
            return response()->json($resData,403);
        }else{
            return $next($request);
        }
    }
}
