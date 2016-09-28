<?php

namespace App\Http\Controllers\User\UserActions;

/*
|--------------------------------------------------------------------------
| 获取用户信息模块
|--------------------------------------------------------------------------
*/

use Illuminate\Http\Request;

class actionGetUserInfo
{
    public static function getUserInfo(Request $request){
        $session_id = $request->cookie('session_id');
        if(!$session_id){
            $resData = config('app.resData.err400');
            $resData['msg'] = '请登录';
            return response()->json($resData,400);
        }

        $userInfo = $request->session()->get($session_id);
        if(!$userInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '登录信息已失效，请重新登录';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['data'] = $userInfo;
            return response()->json($resData,200);
        }
    }
}