<?php

namespace App\Http\Controllers\Shop\ShopActions;

/*
|--------------------------------------------------------------------------
| 获取用户信息模块
|--------------------------------------------------------------------------
*/

use App\Http\Common\Helper;
use App\Models\ShopModel;
use Illuminate\Http\Request;

class actionGetShopInfo
{
    public static function getShopInfo(Request $request){

        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $shopInfo = ShopModel::where('shop_user_id',$userId)
            ->select('shop_id','shop_name','shop_user_id','shop_state')
            ->first();

        if(!$shopInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该用户没有商家信息';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['data'] = $shopInfo;
            return response()->json($resData,200);
        }

    }
}