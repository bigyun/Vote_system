<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Goods\GoodsActions\actionAddGoods;
use App\Http\Controllers\Goods\GoodsActions\actionEditGoods;
use App\Http\Controllers\Goods\GoodsActions\actionGetGoodsInfoById;

class GoodsController extends Controller
{
    /**
     * 增加商品
     * @param $request
     * @return object
     */
    public function addGoods(Request $request)
    {
        return actionAddGoods::addGoods($request);
    }

    /**
     * 编辑商品
     * @param $request
     * @return object
     */
    public function editGoods(Request $request)
    {
        return actionEditGoods::editGoods($request);
    }

    /**
     * @param $goodsId
     * @return object
     */
    public function getGoodsInfoById($goodsId)
    {
        return actionGetGoodsInfoById::getGoodsInfoById($goodsId);
    }


}