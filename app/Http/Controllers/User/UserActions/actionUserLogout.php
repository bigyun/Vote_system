<?php

namespace App\Http\Controllers\User\UserActions;

/*
|--------------------------------------------------------------------------
| 用户退出模块
|--------------------------------------------------------------------------
*/

use Illuminate\Http\Request;

class actionUserLogout
{
    public static function userLogout(Request $request){
        $session_id = $request->cookie('session_id');
        $request->session()->forget($session_id);
        $resData = config('app.resData.success');
        $resData['msg'] = '退出成功';
        return response()->json($resData,200);
    }
}