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

class actionAddBrand
{
    public static function addBrand(Request $request){

        //====================获取当前登录用户的信息=======================
        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $shopInfo = ShopModel::select('shop_id','shop_name','shop_state')->where('shop_user_id',$userId)->first()->toArray();

        //========================商家状态===============================
        if($shopInfo['shop_state'] != 2){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该商家暂时不可添加品牌';
            return response()->json($resData,400);
        }

        //=========================传入参数处理===========================
        $inputBrandData['sb_brand_id']      = $request->input('sb_brand_id');
        $inputBrandData['sb_authorization'] = $request->input('sb_authorization');

        //========================检查参数完整性==========================
        $chInputBrand = Helper::ckParamFull($inputBrandData);
        if($chInputBrand['status'] == false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '参数不足或缺失';
            $resData['err_params'] = $chInputBrand['err_params'];
            return response()->json($resData,400);
        }

        //========================其他参数增加===========================
        $inputBrandData['sb_state']    = 0;
        $inputBrandData['sb_add_time'] = time();
        $inputBrandData['sb_shop_id']  = $shopInfo['shop_id'];

        //========================开始写入数据=========================
        $addBrandInfo = ShopBrandModel::create($inputBrandData);

        //====判断是否保存成功====
        if(!$addBrandInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '品牌添加失败';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['msg'] = '品牌添加成功';
            $resData['data'] = $addBrandInfo['sb_id'];
            return response()->json($resData,200);
        }

    }
}