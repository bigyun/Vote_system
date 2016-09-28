<?php

namespace App\Http\Controllers\User\UserActions;

/*
|--------------------------------------------------------------------------
| 用户登录模块
|--------------------------------------------------------------------------
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class actionCkImgCode
{
    public static function ckImgCode(Request $request){

        $inputCode = $request->input('img_code');
        if(empty($inputCode)){
            $resData = config('app.resData.err400');
            $resData['err_params'] = ['img_code'];
            $resData['msg'] = '参数不足或缺失';
            return response()->json($resData,400);
        }
        $userToken = $request->session()->get('_token');
        $imgCodeKey = 'img_code'.$userToken;
        $imgCode = Redis::get($imgCodeKey);
        if($inputCode == $imgCode){
            $resData = config('app.resData.success');
            $resData['msg'] = '验证码正确';
            return response()->json($resData,200);
        }else{
            $resData = config('app.resData.err400');
            $resData['msg'] = '验证码错误';
            return response()->json($resData,400);
        }
    }
}