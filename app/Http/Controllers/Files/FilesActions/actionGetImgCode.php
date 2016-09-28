<?php

namespace App\Http\Controllers\Files\FilesActions;

/*
|--------------------------------------------------------------------------
| 生成图片验证码
|--------------------------------------------------------------------------
| 返回生成的验证码url地址
*/

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Redis;

class actionGetImgCode
{

    public static function getImgCode(Request $request){

        //====生成图片验证码====
        $builder = new CaptchaBuilder;
        $builder->setBackgroundColor(255,255,255);
        $builder->build();

        //====图片验证码的内容写入Redis====
        $phrase = $builder->getPhrase();
        $userToken = $request->session()->get('_token');
        $imgCodeKey = 'img_code'.$userToken;
        Redis::set($imgCodeKey, $phrase);
        Redis::expire($imgCodeKey, 300);

        $content = $builder->get();
        return response($content)->header('Content-Type', 'image/jpeg');

    }
}