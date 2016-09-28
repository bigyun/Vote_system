<?php

namespace App\Http\Controllers\Buyer\BuyerActions;

/*
|--------------------------------------------------------------------------
| 获取用户信息模块
|--------------------------------------------------------------------------
*/

use App\Http\Common\Helper;
use App\Models\BuyerModel;
use App\Models\UserModel;
use Illuminate\Http\Request;


class actionSaveBuyerInfo
{
    public static function saveBuyerInfo(Request $request){

        //====获取当前登录用户的userId
        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);

        //====必填参数-买家信息表====
        $inputBuyerData['buyer_qq']                   = $request->input('buyer_qq');                    //QQ号
        $inputBuyerData['buyer_tel']                  = $request->input('buyer_tel');                   //买家电话
        $inputBuyerData['buyer_icon']                 = $request->input('buyer_icon');                  //买家图像
        $inputBuyerData['buyer_remark']               = $request->input('buyer_remark');                //备注
        $inputBuyerData['buyer_website']              = $request->input('buyer_website');               //网店网址
        $inputBuyerData['buyer_is_shop']              = $request->input('buyer_is_shop');               //店铺性质 1 实体店 2 网店 3 其他
        $inputBuyerData['buyer_id_card']              = $request->input('buyer_id_card');               //身份证号码
        $inputBuyerData['buyer_city_id']              = $request->input('buyer_city_id');               //店铺所在城市
        $inputBuyerData['buyer_address']              = $request->input('buyer_address');               //街道地址
        $inputBuyerData['buyer_realname']             = $request->input('buyer_realname');              //用户真实姓名
        $inputBuyerData['buyer_wangwang']             = $request->input('buyer_wangwang');              //旺旺号
        $inputBuyerData['buyer_city_name']            = $request->input('buyer_city_name');             //店铺所在城市的名称
        $inputBuyerData['buyer_country_id']           = $request->input('buyer_country_id');            //县或地区id
        $inputBuyerData['buyer_province_id']          = $request->input('buyer_province_id');           //店铺所在省份
        $inputBuyerData['buyer_id_card_img']          = $request->input('buyer_id_card_img');           //身份证扫描件（正反2张图）
        $inputBuyerData['buyer_company_name']         = $request->input('buyer_company_name');          //店铺名称
        $inputBuyerData['buyer_country_name']         = $request->input('buyer_country_name');          //县或地区名
        $inputBuyerData['buyer_is_good_shop']         = $request->input('buyer_is_good_shop');          //货品性质 1 女装 2 童装 3女装/童装 4其他
        $inputBuyerData['buyer_province_name']        = $request->input('buyer_province_name');         //店铺所在的省份的名称
        $inputBuyerData['buyer_business_licence']     = $request->input('buyer_business_licence');      //营业执照
        $inputBuyerData['buyer_business_licence_img'] = $request->input('buyer_business_licence_img');  //营业执照图片

        //====必填参数-用户信息表====
        $inputUserData['user_nick']  = $request->input('user_nick');   //用户昵称

        //====检查参数完整性====
        $chReBuyer = Helper::ckParamFull($inputBuyerData);
        $chReUser = Helper::ckParamFull($inputUserData);
        if($chReBuyer['status'] == false || $chReUser['status'] == false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '参数不足或缺失';
            $resData['err_params'] = array_merge($chReBuyer['err_params'],$chReUser['err_params']);
            return response()->json($resData,400);
        }

        //====保存用户表数据====
        $saveUserInfo = UserModel::where('user_id',$userId)->update($inputUserData);
        if($saveUserInfo === false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '用户信息保存失败';
            return response()->json($resData,400);
        }

        //====判断是否存在买家信息====
        //====如该买家信息不存在，则新加该买家信息
        //====如该买家信息已存在，则修改该买家信息
        $buyerInfo = BuyerModel::where('buyer_user_id',$userId)->first();
        if(!$buyerInfo){
            $saveBuyerInfo = BuyerModel::create($inputBuyerData);
        }else{
            $saveBuyerInfo = BuyerModel::where('buyer_user_id',$userId)->update($inputBuyerData);
        }

        //====判断是否保存成功====
        if(!$saveBuyerInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '买家信息保存失败';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['msg'] = '买家信息保存成功';
            $resData['data'] = $saveBuyerInfo['buyer_id'];
            return response()->json($resData,200);
        }

    }
}