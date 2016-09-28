<?php

namespace App\Http\Controllers\User\UserActions;

/*
|--------------------------------------------------------------------------
| 用户注册模块
|--------------------------------------------------------------------------
*/

use App\Models\UserModel;
use App\Http\Common\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class actionUserRegister
{
    public static function userRegister(Request $request){
        //=====接收处理数据============
        $userToken = $request->session()->get('_token');

        $inputUserData['user_pwd']    = $request->input('user_pwd');
        $inputUserData['user_pwd_re'] = $request->input('user_pwd_re');
        $inputUserData['user_mobile'] = $request->input('user_mobile');
        $inputUserData['img_code']    = $request->input('img_code');
        $inputUserData['msg_code']    = $request->input('msg_code');

        //========检查参数完整性======
        $chRe = Helper::ckParamFull($inputUserData);
        if($chRe['status'] == false){
            $resData = config('app.resData.err400');
            $resData['err_params'] = $chRe['err_params'];
            $resData['msg'] = '参数不足或缺失';
            return response()->json($resData,400);
        }

        //=====判断两次密码是否相同======
        if($inputUserData['user_pwd'] != $inputUserData['user_pwd_re']){
            $resData = config('app.resData.err400');
            $resData['err_params'] = ['user_pwd','user_pwd_re'];
            return response()->json($resData,400);
        };

        //=====判断是否已经存在该用户=====
        $userInfo = UserModel::where('user_mobile',$inputUserData['user_mobile'])->first();
        if($userInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该手机号已注册，请直接登录';
            return response()->json($resData,400);
        }

        //====判断图片验证码是否正确====
        $imgCodeKey = 'img_code'.$userToken;
        $imgCode = Redis::get($imgCodeKey);
        if($imgCode != $inputUserData['img_code']){
            $resData = config('app.resData.err400');
            $resData['msg'] = '图片验证码错误';
            return response()->json($resData,400);
        }

        //====判断短信验证码是否正确====
        $msgCodeKey = 'msg_code'.$userToken;
        $msgCode = Redis::get($msgCodeKey);
        if($msgCode != $inputUserData['msg_code']){
            $resData = config('app.resData.err400');
            $resData['msg'] = '短信验证码错误';
            return response()->json($resData,400);
        }

        //=====执行数据添加=============
        $dbRe = UserModel::register($inputUserData);
        if(!$dbRe){
            $resData = config('app.resData.err503');
            return response()->json($resData,503);
        }else{
            //=====注册完成后立即登录=========
            $sessionData['userId']   = $dbRe->user_id;
            $sessionData['userType'] = $dbRe->user_type;
            $sessionData['userNick'] = $dbRe->user_nick;
            $sessionData['username'] = $dbRe->user_name;
            $sessionData['loginTime']= time();
            $sessionData['isLogin']  = true;
            $cookieUid = Helper::makeCookieUid($sessionData);
            $dbRe['userKey'] = sprintf(Helper::USER_INFO,$cookieUid);
            $resData = config('app.resData.success');
            $resData['msg'] = '注册成功';
            $request->session()->set($dbRe['userKey'],$sessionData);
            return response()->json($resData,200)->withCookie('session_id',$dbRe['userKey']);
        }
    }
}