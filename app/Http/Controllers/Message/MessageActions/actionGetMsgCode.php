<?php

namespace App\Http\Controllers\Message\MessageActions;

/*
|--------------------------------------------------------------------------
| 获取短信验证码
|--------------------------------------------------------------------------
*/

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Common\Helper;
use Illuminate\Support\Facades\Redis;

class actionGetMsgCode
{
    public static function getMsgCode(Request $request){

        //====验证手机号码====
        $userMobile = $request->get('user_mobile');
        if(empty($userMobile)){
            $resData = config('app.resData.err400');
            $resData['err_params'] = ['user_mobile'];
            $resData['msg'] = '参数不足或缺失';
            return response()->json($resData,400);
        }

        //====生成随机数-纯数字====
        $msgCode = Helper::getRandom(6,1);

        //====将短信验证码写入redis====
        $userToken = $request->session()->get('_token');
        $msgCodeKey = 'msg_code'.$userToken;
        Redis::set($msgCodeKey, $msgCode);
        Redis::expire($msgCodeKey, 60);

        //====发送短信====
        $client   = new Client();
        $account  = config('app.HUYI.ACCOUNT');
        $password = config('app.HUYI.APIKEY');
        $smsUrl   = config('app.HUYI.BASEURL')."?method=Submit";
        $content  = "您的验证码是：{$msgCode}。请不要把验证码泄露给其他人。";
        $response = $client->request('POST',$smsUrl,[
            'form_params' => [
                'account'  => $account,
                'password' => $password,
                'mobile'   => $userMobile,
                'content'  => $content,
            ]
        ]);

        //====解析xml====
        $resStr = $response->getBody()->getContents();
        $smsOb = simplexml_load_string($resStr);

        if($smsOb){
            $resData = config('app.resData.success');
            $resData['date'] = $smsOb;
            return response()->json($resData,200);
        }else{
            $resData = config('app.resData.err500');
            return response()->json($resData,500);
        }
    }
}