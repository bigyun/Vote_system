<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\ShopActions\actionGetShopInfo;
use App\Http\Controllers\Shop\ShopActions\actionSaveShopInfo;
use App\Http\Controllers\Shop\ShopActions\actionEditShopInfo;

class ShopInfoController extends Controller
{
    /**
     * 获取商家信息
     * @param $request
     * @return object
     */
    public function getShopInfo(Request $request)
    {
        return actionGetShopInfo::getShopInfo($request);
    }

    /**
     * 商家信息注册
     * @param $request
     * @return object
     */
    public function saveShopInfo(Request $request)
    {
        return actionSaveShopInfo::saveShopInfo($request);
    }

    /**
     * 商家信息修改
     * @param $request
     * @return object
     */
    public function editShopInfo(Request $request)
    {
        return actionEditShopInfo::editShopInfo($request);
    }

}