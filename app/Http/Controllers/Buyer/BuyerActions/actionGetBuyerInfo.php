<?php

namespace App\Http\Controllers\Buyer\BuyerActions;

/*
|--------------------------------------------------------------------------
| 获取用户信息模块
|--------------------------------------------------------------------------
*/

use App\Http\Common\Helper;
use App\Models\BuyerModel;
use Illuminate\Http\Request;

class actionGetBuyerInfo
{
    public static function getBuyerInfo(Request $request){

        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $buyerInfo = BuyerModel::where('buyer_user_id',$userId)
            ->select('buyer_id','buyer_user_id','buyer_state')
            ->first();

        if(!$buyerInfo){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该用户没有买家信息';
            return response()->json($resData,400);
        }else{
            $resData = config('app.resData.success');
            $resData['data'] = $buyerInfo;
            return response()->json($resData,200);
        }

    }
}