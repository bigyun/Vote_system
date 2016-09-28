<?php

namespace App\Http\Middleware;

use Closure;

class isLoginMiddleware
{
    /**
     * 用户中间件，负责校验用户是否登录
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session_id = $request->cookie('session_id');
        $userInfo = $request->session()->has($session_id);
        if(!$session_id || !$userInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '请重新登录';
            return response()->json($resData,400);
        }else{
            return $next($request);
        }
    }
}
