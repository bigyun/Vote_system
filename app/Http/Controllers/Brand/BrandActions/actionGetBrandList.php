<?php

namespace App\Http\Controllers\Brand\BrandActions;

/*
|--------------------------------------------------------------------------
| 获取用户信息模块
|--------------------------------------------------------------------------
*/

use App\Http\Common\Helper;
use App\Models\Brand\ShopBrandModel;
use App\Models\ShopModel;
use Illuminate\Http\Request;

class actionGetBrandList
{
    public static function getBrandList(Request $request, $state){

        //====================获取当前登录用户的信息=======================
        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $shopInfo = ShopModel::select('shop_id','shop_name','shop_state')->where('shop_user_id',$userId)->first()->toArray();

        $shopBrandList = ShopBrandModel::select('sb_id','sb_brand_id','sb_authorization')->where(['sb_shop_id'=>$shopInfo['shop_id'],'sb_state'=>$state])->get();

        //====返回数据====
        $resData = config('app.resData.success');
        $resData['data'] = $shopBrandList;
        return response()->json($resData,200);

    }
}