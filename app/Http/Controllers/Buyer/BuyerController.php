<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Buyer\BuyerActions\actionGetBuyerInfo;
use App\Http\Controllers\Buyer\BuyerActions\actionSaveBuyerInfo;

class BuyerController extends Controller
{
    /**
     * 获取买家信息
     * @param $request
     * @return object
     */
    public function getBuyerInfo(Request $request)
    {
        return actionGetBuyerInfo::getBuyerInfo($request);
    }

//    /**
//     * 买家信息注册
//     * @param $request
//     * @return object
//     */
//    public function addShopInfo(Request $request)
//    {
//        return actionAddBuyerInfo::addBuyerInfo($request);
//    }

    /**
     * 买家信息修改
     * @param $request
     * @return object
     */
    public function saveBuyerInfo(Request $request)
    {
        return actionSaveBuyerInfo::saveBuyerInfo($request);
    }

}