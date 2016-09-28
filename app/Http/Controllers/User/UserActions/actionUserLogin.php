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

class actionUserLogin
{
    public static function userLogin(Request $request){
        $inputUserMob = $request->input('user_mobile');
        $inputUserPwd = $request->input('user_pwd');
        $ckParam = [
            'user_mobile' => $inputUserMob,
            'user_pwd'    => $inputUserPwd
        ];

        //========检查参数完整性======
        $chRe = Helper::ckParamFull($ckParam);
        if($chRe['status'] == false){
            $resData = config('app.resData.err400');
            $resData['err_params'] = $chRe['err_params'];
            $resData['msg'] = '参数不足或缺失';
            return response()->json($resData,400);
        }

        //========检查用户密码========
        $userHashPwd = Helper::toHashPwd($inputUserPwd);
        $dbUserData = UserModel::where('user_mobile',$inputUserMob)->where('user_pwd',$userHashPwd)->first();
        if(empty($dbUserData)){
            $resData = config('app.resData.err400');
            $resData['msg'] = '用户名或密码错误';
            return response()->json($resData,400);
        }else{

            //======设置session完成登录========
            $sessionData['userId']   = $dbUserData->user_id;
            $sessionData['userType'] = $dbUserData->user_type;
            $sessionData['userNick'] = $dbUserData->user_nick;
            $sessionData['username'] = $dbUserData->user_name;
            $sessionData['loginTime']= time();
            $sessionData['isLogin']  = true;
            $cookieUid = Helper::makeCookieUid($sessionData);
            $userKey = sprintf(Helper::USER_INFO,$cookieUid);
            $resData = config('app.resData.success');
            $resData['msg'] = '登录成功';
            $request->session()->set($userKey,$sessionData);
            return response()->json($resData,200)->withCookie('session_id',$userKey);
        }
    }
}