<?php

namespace App\Http\Controllers\Shop\ShopActions;

/*
|--------------------------------------------------------------------------
| 保存用户信息
|--------------------------------------------------------------------------
| 这里有两种状态
| 第一是商家信息没有，属于增加
| 第二是商家信息已经有了，属于修改
|
*/

use App\Models\ShopModel;
use App\Models\UserModel;
use App\Http\Common\Helper;
use Illuminate\Http\Request;

class actionSaveShopInfo
{
    public static function saveShopInfo(Request $request){
        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $userInfo = ShopModel::where('shop_user_id',$userId)->first();

        //====校验参数====
        //====必填参数-商家信息表====
        $inputShopData['shop_tel']              = $request->input('shop_tel');                  //店铺电话
        $inputShopData['shop_name']             = $request->input('shop_name');                 //店铺名称
        $inputShopData['shop_mobile']           = $request->input('shop_mobile');               //店主手机
        $inputShopData['shop_is_cod']           = $request->input('shop_is_cod');               //是否支持货到付款
        $inputShopData['shop_address']          = $request->input('shop_address');              //街道地址
        $inputShopData['shop_id_card']          = $request->input('shop_id_card');              //法人身份证
        $inputShopData['shop_city_id']          = $request->input('shop_city_id');              //店铺所在城市
        $inputShopData['shop_worktime']         = $request->input('shop_worktime');             //客服工作时间
        $inputShopData['shop_is_entity']        = $request->input('shop_is_entity');            //是否有实体店
        $inputShopData['shop_is_return']        = $request->input('shop_is_return');            //7天无理由退货
        $inputShopData['shop_nature_id']        = $request->input('shop_nature_id');            //店铺性质
        $inputShopData['shop_real_name']        = $request->input('shop_real_name');            //店主姓名
        $inputShopData['shop_is_genuine']       = $request->input('shop_is_genuine');           //是否有正品保障服务
        $inputShopData['shop_country_id']       = $request->input('shop_country_id');           //县或地区id
        $inputShopData['shop_province_id']      = $request->input('shop_province_id');          //店铺所在省份
        $inputShopData['shop_is_exchange']      = $request->input('shop_is_exchange');          //是否有15天换货服务
        $inputShopData['shop_company_name']     = $request->input('shop_company_name');         //店铺公司名称
        $inputShopData['shop_is_fast_delivery'] = $request->input('shop_is_fast_delivery');     //是否有2小时快速发货服务
        $inputShopData['shop_business_licence'] = $request->input('shop_business_licence');     //营业执照号码

        //====必填参数-用户信息表====
        $inputUserData['user_nick']  = $request->input('user_nick');        //用户昵称
        $inputUserData['user_email'] = $request->input('user_email');       //用户邮箱

        //====检查参数完整性====
        $chReShop = Helper::ckParamFull($inputShopData);
        $chReUser = Helper::ckParamFull($inputUserData);
        if($chReShop['status'] == false || $chReUser['status'] == false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '参数不足或缺失';
            $resData['err_params'] = array_merge($chReShop['err_params'],$chReUser['err_params']);
            return response()->json($resData,400);
        }

        //====非必填的参数====
        $inputShopData['shop_qq']          = $request->input('shop_qq');            //商家QQ
        $inputShopData['shop_ww']          = $request->input('shop_ww');            //商家旺旺
        $inputShopData['shop_remark']      = $request->input('shop_remark');        //备注
        $inputShopData['shop_website']     = $request->input('shop_website');       //店铺网址
        $inputShopData['shop_seo_keyword'] = $request->input('shop_seo_keyword');   //SEO搜索关键字

        //====自动生成参数====
        $inputShopData['shop_logo']                 = $request->input('shop_logo');                 //店铺logo
        $inputShopData['shop_type']                 = $request->input('shop_type');                 //店铺类型
        $inputShopData['shop_state']                = $request->input('shop_state');                //店铺状态
        $inputShopData['shop_user_id']              = $request->input('shop_user_id');              //用户ID
        $inputShopData['shop_add_time']             = $request->input('shop_add_time');             //店铺申请开店的时间
        $inputShopData['shop_end_time']             = $request->input('shop_end_time');             //店铺关闭时间
        $inputShopData['shop_domain_name']          = $request->input('shop_domain_name');          //二级域名
        $inputShopData['shop_verify_time']          = $request->input('shop_verify_time');          //店铺审核通过的时间
        $inputShopData['shop_id_card_img']          = $request->input('shop_id_card_img');          //身份证图片
        $inputShopData['shop_trademark_img']        = $request->input('shop_trademark_img');        //商标图
        $inputShopData['shop_business_licence_img'] = $request->input('shop_business_licence_img'); //营业执照电子档

        //====保存用户表数据====
        $userInfoModel = UserModel::where('user_id',$userId)->update($inputUserData);
        if($userInfoModel === false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '保存失败';
            return response()->json($userInfoModel,400);
        }

        //====判断是否存在商家信息====
        //====如该商家信息不存在，则新加该商家信息
        //====如该商家信息已存在，则修改该商家信息
        if(!$userInfo){
            $shopInfoModel = ShopModel::create($inputShopData);
        }else{
            $shopInfoModel = ShopModel::where('shop_user_id',$userId)->update($inputShopData);
        }

        //====判断是否保存成功====
        if(!$shopInfoModel){
            $resData = config('app.resData.err400');
            $resData['msg'] = '保存失败';
            return response()->json($shopInfoModel,400);
        }else{
            $resData = config('app.resData.success');
            $resData['msg'] = '保存成功';
            $resData['shop_id'] = $shopInfoModel['shop_id'];
            return response()->json($resData,200);
        }

    }
}