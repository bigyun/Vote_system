<?php

namespace App\Http\Controllers\User\UserActions;

/*
|--------------------------------------------------------------------------
| 用户登录模块
|--------------------------------------------------------------------------
*/

use App\Models\UserModel;
use App\Http\Common\Helper;
use Illuminate\Http\Request;

class actionCkIsReg
{
    public static function ckIsReg(Request $request){
        $user_mobile = $request->input('user_mobile');

        //判断参数是否完整
        if(empty($user_mobile)){
            $resData = config('app.resData.err400');
            $resData['msg'] = '参数不足或缺失';
            $resData['err_params'] = ['user_mobile'];
            return response()->json($resData,400);
        }

        //检测是否已注册
        $dbUserData = UserModel::where('user_mobile',$user_mobile)->first();
        if($dbUserData){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该手机号已注册';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['msg'] = '该手机号未注册';
            return response()->json($resData,200);
        }
    }
}