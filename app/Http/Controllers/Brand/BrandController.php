<?php

namespace App\Http\Controllers\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Brand\BrandActions\actionAddBrand;
use App\Http\Controllers\Brand\BrandActions\actionEditBrand;
use App\Http\Controllers\Brand\BrandActions\actionGetBrandList;

class BrandController extends Controller
{
    /**
     * 获取品牌信息
     * @param $request
     * @param $state
     * @return object
     */
    public function getBrandList(Request $request, $state)
    {
        return actionGetBrandList::getBrandList($request,$state);
    }

    /**
     * 增加品牌
     * @param $request
     * @return object
     */
    public function addBrand(Request $request)
    {
        return actionAddBrand::addBrand($request);
    }

    /**
     * 编辑品牌
     * @param $request
     * @return object
     */
    public function editBrand(Request $request)
    {
        return actionEditBrand::editBrand($request);
    }

}