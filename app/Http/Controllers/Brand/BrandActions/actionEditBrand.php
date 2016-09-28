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

class actionEditBrand
{
    public static function editBrand(Request $request){

        //====================获取当前登录用户的信息=======================
        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $shopInfo = ShopModel::select('shop_id','shop_name','shop_state')->where('shop_user_id',$userId)->first()->toArray();

        //========================商家状态===============================
        if($shopInfo['shop_state'] != 2){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该商家暂时不可编辑品牌';
            return response()->json($resData,400);
        }

        //=========================传入参数处理===========================
        $inputBrandData['sb_id']            = $request->input('sb_id');
        $inputBrandData['sb_shop_id']       = $shopInfo['shop_id'];
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

        //========================开始更新数据=========================
        $editBrandInfo = ShopBrandModel::where('sb_id', $inputBrandData['sb_id'])->update($inputBrandData);

        //====判断是否保存成功====
        if($editBrandInfo === false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '品牌修改失败';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['msg'] = '品牌修改成功';
            return response()->json($resData,200);
        }

    }
}