<?php

namespace App\Http\Controllers\User;

/*
|--------------------------------------------------------------------------
| 用户模块控制器
|--------------------------------------------------------------------------
|
| 负责用户登录，用户注册，密码重置
|
|
*/

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserActions\actionCkIsReg;
use App\Http\Controllers\User\UserActions\actionCkImgCode;
use App\Http\Controllers\User\UserActions\actionUserLogin;
use App\Http\Controllers\User\UserActions\actionUserLogout;
use App\Http\Controllers\User\UserActions\actionGetUserInfo;
use App\Http\Controllers\User\UserActions\actionUserRegister;

class UserController extends Controller
{

    /**
     *  用户注册
     * @param $request
     * @return object
     */
    public function userRegister(Request $request)
    {
        return actionUserRegister::userRegister($request);
    }

    /**
     *  用户登录
     * @param $request
     * @return object
     */
    public function userLogin(Request $request)
    {
        return actionUserLogin::userLogin($request);
    }

    /**
     *  获取用户信息
     * @param $request
     * @return  object
     */
    public function getUserInfo(Request $request)
    {
        return actionGetUserInfo::getUserInfo($request);
    }

    /**
     *  退出登录
     * @param $request
     * @return  object
     */
    public function userLogout(Request $request)
    {
        return actionUserLogout::userLogout($request);
    }

    /**
     * 检测是该账号否注册
     * @param $request
     * @return object
     */
    public function ckIsReg(Request $request)
    {
        return actionCkIsReg::ckIsReg($request);
    }

    /**
     * 检测验证码是否正确
     * @param $request
     * @return object
     */
    public function ckImgCode(Request $request)
    {
        return actionCkImgCode::ckImgCode($request);
    }

}