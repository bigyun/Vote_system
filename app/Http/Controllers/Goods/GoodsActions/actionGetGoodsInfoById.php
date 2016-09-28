<?php

namespace App\Http\Controllers\Goods\GoodsActions;

/*
|--------------------------------------------------------------------------
| 通过商品id获取商品信息
|--------------------------------------------------------------------------
| 返回商品的具体信息
*/

use App\Models\Goods\GoodsModel;

class actionGetGoodsInfoById
{

    public static function getGoodsInfoById($goodsId){

        $goodsInfoObj = GoodsModel::with('goodsPro','goodsProValue')->where('goods_id',6)->first();
        $goodsInfo = $goodsInfoObj->toArray();

        print_r($goodsInfo);

    }
}