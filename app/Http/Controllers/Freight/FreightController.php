<?php

namespace App\Http\Controllers\Freight;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Freight\FreightActions\actionsAddFreight;
use App\Http\Controllers\Freight\FreightActions\actionsEditFreight;
use App\Http\Controllers\Freight\FreightActions\actionsGetShopFreightList;

class FreightController extends Controller
{
    /**
     * 获取物流列表
     * @param $request
     * @return object
     */
    public function getShopFreightList(Request $request)
    {
        return actionsGetShopFreightList::getShopFreightList($request);
    }

    /**
     * 增加品牌
     * @param $request
     * @return object
     */
    public function addFreight(Request $request)
    {
        return actionsAddFreight::addFreight($request);
    }

    /**
     * 编辑品牌
     * @param $request
     * @return object
     */
    public function editFreight(Request $request)
    {
        return actionsEditFreight::editFreight($request);
    }

}