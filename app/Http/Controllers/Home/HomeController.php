<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\HomeActions\actionGetIndex;

class HomeController extends Controller
{
    /**
     * 获取广告数据
     * @param $request
     * @return object
     */
    public function getIndex(Request $request)
    {
        return actionGetIndex::getIndex($request);
    }

    /**
     * 获取热卖商品列表
     */
    public function getHostGoodsList()
    {

    }

    /**
     * 获取组货列表
     */
    public function getGroupList()
    {

    }

    /**
     * 获取主题列表
     */
    public function getThemeList()
    {

    }

    /**
     * 获取品牌列表
     */
    public function getBrandList()
    {

    }


}