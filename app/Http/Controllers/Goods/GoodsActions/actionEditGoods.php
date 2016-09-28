<?php

namespace App\Http\Controllers\Goods\GoodsActions;

/*
|--------------------------------------------------------------------------
| 增加商品
|--------------------------------------------------------------------------
| 返回生成的商品Id
*/

use DB;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\Goods\GoodsModel;
use App\Models\Goods\GoodsCategoryModel;
use App\Http\Common\Helper;
use Illuminate\Http\Request;

class actionEditGoods
{

    public static function editGoods(Request $request){

        //====================获取当前登录用户的信息=======================
        $session_id = $request->cookie('session_id');
        $userId = Helper::getUserIdBySession($session_id);
        $shopInfo = ShopModel::select('shop_id','shop_name','shop_state')->where('shop_user_id',$userId)->first()->toArray();

        //=========================传入参数处理===========================
        $inputData['goods_id']             = $request->input('goods_id');
        $inputData['goods_sn']             = $request->input('goods_sn');
        $inputData['goods_cate']           = $request->input('goods_cate');
        $inputData['goods_desc']           = $request->input('goods_desc');
        $inputData['goods_name']           = $request->input('goods_name');
        $inputData['goods_spec']           = $request->input('goods_spec');
        $inputData['goods_attr']           = $request->input('goods_attr');
        $inputData['goods_stock']          = $request->input('goods_stock');
        $inputData['goods_weight']         = $request->input('goods_weight');
        $inputData['shop_category']        = $request->input('shop_category');
        $inputData['goods_img_all']        = $request->input('goods_img_all');
        $inputData['goods_subtitle']       = $request->input('goods_subtitle');
        $inputData['goods_startnum']       = $request->input('goods_startnum');
        $inputData['goods_brand_id']       = $request->input('goods_brand_id');
        $inputData['goods_is_recom']       = $request->input('goods_is_recom');
        $inputData['goods_warn_stock']     = $request->input('goods_warn_stock');
        $inputData['goods_market_price']   = $request->input('goods_market_price');
        $inputData['goods_transfee_type']  = $request->input('goods_transfee_type');
        $inputData['goods_price_strategy'] = $request->input('goods_price_strategy');

        //========================检查参数完整性==============================
        $ckInputData = Helper::ckParamFull($inputData);
        $ckGoodsSpec = Helper::ckParamFull($inputData['goods_spec']);
        if($ckInputData['status'] == false || $ckGoodsSpec['status'] == false){
            $resData = config('app.resData.err400');
            $resData['msg'] = '参数不足或缺失';
            $resData['err_params'] = array_merge($ckInputData['err_params'],$ckGoodsSpec['err_params']);
            return response()->json($resData,400);
        }

        //=========================系统数据获取判断============================
        $editGoodsData          = array();
        $editGoodsProData       = array();
        $editShopCateGoods      = array();
        $editGoodsAttrValueData = array();
        //====商家状态====
        if($shopInfo['shop_state'] != 2){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该商家暂时不可修改商品';
            return response()->json($resData,400);
        }

        //====商家是否有权修改该商品====
        $goodsShopInfo = GoodsModel::select('goods_shop_id')->where('goods_id',$inputData['goods_id'])->first()->toArray();
        if(!$goodsShopInfo || $goodsShopInfo['goods_shop_id'] != $shopInfo['shop_id']){
            $resData = config('app.resData.err400');
            $resData['msg'] = '该商家无权修改该商品';
            return response()->json($resData,400);
        }

        //====商品推荐数量====
        $goodsRecommendNum = GoodsModel::where(['goods_shop_id'=>$shopInfo['shop_id'],'goods_is_recom'=>1])->count();
        if($inputData['goods_is_recom'] && $goodsRecommendNum >= 4){
            $resData = config('app.resData.err400');
            $resData['msg'] = '推荐商品最多为4个';
            return response()->json($resData,400);
        }

        //====商品分类树获取====
        $cateAll  = GoodsCategoryModel::select('cat_id','cat_name','cat_parent_id')->get()->toArray();
        $cateTree = Helper::getTreeArr($cateAll,$inputData['goods_cate']['cate_id'],'cat_id','cat_parent_id');
        $editGoodsData['goods_cid']  = $inputData['goods_cate']['cate_id'];
        $editGoodsData['goods_cid1'] = $cateTree['cat_id'];
        if($cateTree['son_data']){
            $editGoodsData['goods_cid2'] = $cateTree['son_data']['cat_id'];
            if($cateTree['son_data']['son_data']){
                $editGoodsData['goods_cid3'] = $cateTree['son_data']['son_data']['cat_id'];
            }
        }

        //====商品价格计算====
        $proPriceArr = array();
        foreach ($inputData['goods_spec']['goods_pro_list'] as $value){
            $proPriceArr[] = $value['price'];
        }
        if($inputData['goods_price_strategy']['price_type'] == 1){
            $proMinPrice = min($proPriceArr) - max($inputData['goods_price_strategy']['member_price']);
            $proMaxPrice = max($proPriceArr) - min($inputData['goods_price_strategy']['member_price']);
        }elseif ($inputData['goods_price_strategy']['price_type'] == 2){
            $proMinPrice = min($proPriceArr) - max($inputData['goods_price_strategy']['batch_price']);
            $proMaxPrice = max($proPriceArr) - min($inputData['goods_price_strategy']['batch_price']);
        }else{
            $proMinPrice = min($proPriceArr);
            $proMaxPrice = max($proPriceArr);
        }
        if($proMinPrice == $proMaxPrice){
            $proPrice = number_format($proMinPrice,2);
        }else{
            $proPrice = number_format($proMinPrice,2) .'~'. number_format($proMaxPrice,2);
        }
        $editGoodsData['goods_price'] = $proPrice;

        //====条形码随机数获取====
        $randNum = Helper::getRandom(9,true);
        $editGoodsData['goods_sn'] = $randNum.$inputData['goods_sn'];

        //====SEO关键字组合====
        $brandObj = BrandModel::select('brand_name')->where('brand_id',$inputData['goods_brand_id'])->first();
        if(!$brandObj){
            $resData = config('app.resData.err400');
            $resData['msg'] = '品牌选择错误';
            return response()->json($resData,400);
        }
        $brandArr = $brandObj->toArray();
        $keyWord = Helper::getKeyWordStr($inputData['goods_sn'],$shopInfo['shop_name'],$brandArr['brand_name'],$inputData['goods_spec']['goods_pro_list'],$inputData['goods_attr']);
        $editGoodsData['goods_keyword'] = $keyWord;

        //====图片处理====
        if(!$inputData['goods_img_all']['img_0']){
            $resData = config('app.resData.err400');
            $resData['msg'] = '商品主图不能为空';
            return response()->json($resData,400);
        }
        $editGoodsData['goods_img']      = $inputData['goods_img_all']['img_0'];
        $editGoodsData['goods_img_more'] = implode(',',$inputData['goods_img_all']);

        //====属性序列化====

        //=============================其他数据组装=================================
        //====goods表====
        $editGoodsData['goods_name']             = $inputData['goods_name'];              //商品名称
        $editGoodsData['goods_desc']             = $inputData['goods_desc'];              //商品描述
        $editGoodsData['goods_stock']            = $inputData['goods_stock'];             //商品目前的真实库存(会适时更新)
        $editGoodsData['goods_weight']           = $inputData['goods_weight'];            //商品重量（克）
        $editGoodsData['goods_cat_name']         = $inputData['goods_cate']['cate_name']; //商品分类名称
        $editGoodsData['goods_is_recom']         = $inputData['goods_is_recom'];          //是否是推荐商品
        $editGoodsData['goods_subtitle']         = $inputData['goods_subtitle'];          //商品卖点
        $editGoodsData['goods_brand_id']         = $inputData['goods_brand_id'];          //品牌id
        $editGoodsData['goods_startnum']         = $inputData['goods_startnum'];          //起批量
        $editGoodsData['goods_price_type']       = $inputData['goods_price_strategy']['price_type'];//价格模式：0一口价1会员价2批发价
        $editGoodsData['goods_market_price']     = $inputData['goods_market_price'];      //建议零售价
        $editGoodsData['goods_transfee_type']    = $inputData['goods_transfee_type'];     //商品运费承担方式 默认 0为买家承担 1为卖家承担
        $editGoodsData['goods_state']            = '0';                                   //10 草稿，0为未审核，1为审核通过，2审核未通过, 3正常，4 违规下架, 5已关闭
        $editGoodsData['goods_user_id']          = $userId;                               //用户uid
        $editGoodsData['goods_shop_id']          = $shopInfo['shop_id'];                  //商家id
        $editGoodsData['goods_subtitle']         = $inputData['goods_subtitle'];          //商品卖点(已经使用)
        $editGoodsData['goods_warn_stock']       = $inputData['goods_warn_stock'];        //库存报警值(暂时没有警告提醒功能)

        //====goods_pro表====
        $specName = json_encode([213=>'颜色',214=>'尺码']);
        foreach ($inputData['goods_spec']['goods_pro_list'] as $key => $value){
            $specValue    = json_encode([213=>[$value['color_id']=>$value['color_name']],214=>[$value['size_id']=>$value['size_name']]]);
            $specValueStr = json_encode([$value['color_id']=>$value['color_name'],$value['size_id']=>$value['size_name']]);
            $editGoodsProData[$key]['pro_sn']               = $randNum.$value['sku'];               //规格商品编号
            $editGoodsProData[$key]['pro_price']            = $value['price'];             //SKU对应的价格
            $editGoodsProData[$key]['pro_stock']            = $value['stock'];             //规格实际商品库存
            $editGoodsProData[$key]['pro_in_price']         = $value['pleased'];           //SKU对应的进货价
            $editGoodsProData[$key]['pro_spec_name']        = $specName;                          //规格名称
            $editGoodsProData[$key]['pro_img_small']        = $value['img'];               //商品颜色图
            $editGoodsProData[$key]['pro_spec_value']       = $specValue;                          //商品规格序列化
            $editGoodsProData[$key]['pro_publish_time']     = time();                      //SKU发布时间
            $editGoodsProData[$key]['pro_spec_valuelist']   = $value['color_id'] .'-'.$value['size_id'];  //规格id的拼接码
            $editGoodsProData[$key]['pro_spec_valuestring'] = $specValueStr;                          //商品规格序列化
        }

        //====goods_pro_value表====
        $editGoodsProValueColor = array();
        $editGoodsProValueSize  = array();
        foreach ($inputData['goods_spec']['color_select'] as $key => $value){
            $editGoodsProValueColor[$key]['pv_sp_id']         = 213;        //规格id
            $editGoodsProValueColor[$key]['pv_cat_id']        = $inputData['goods_cate']['cate_id'];       //商品分类id
            $editGoodsProValueColor[$key]['pv_img_small']     = $value['img'];    //颜色图
            $editGoodsProValueColor[$key]['pv_sp_value_id']   = $value['id'];  //规格值id
            $editGoodsProValueColor[$key]['pv_sp_value_name'] = $value['name'];//规格值名称
            $editGoodsProValueColor[$key]['pv_sp_value_code'] = $value['code'];//编码
            $editGoodsProValueColor[$key]['pv_sp_value_note'] = $value['note'];//规格备注
        }

        foreach ($inputData['goods_spec']['size_select'] as $key => $value){
            $editGoodsProValueSize[$key]['pv_sp_id']         = 214;        //规格id
            $editGoodsProValueSize[$key]['pv_cat_id']        = $inputData['goods_cate']['cate_id'];       //商品分类id
            $editGoodsProValueSize[$key]['pv_img_small']     = '';            //颜色图
            $editGoodsProValueSize[$key]['pv_sp_value_id']   = $value['id'];  //规格值id
            $editGoodsProValueSize[$key]['pv_sp_value_name'] = $value['name'];//规格值名称
            $editGoodsProValueSize[$key]['pv_sp_value_code'] = $value['code'];//编码
            $editGoodsProValueSize[$key]['pv_sp_value_note'] = $value['note'];//规格备注
        }

        //====将颜色与尺码合并====
        $editGoodsProValueData = array_merge($editGoodsProValueColor,$editGoodsProValueSize);

        //====goods_attr_value表====
        foreach ($inputData['goods_attr'] as $key => $value){
            $editGoodsAttrValueData[$key]['gav_cat_id']          = $inputData['goods_cate']['cate_id'];   //商品分类id
            $editGoodsAttrValueData[$key]['gav_attr_id']         = $value['id'];        //属性id
            $editGoodsAttrValueData[$key]['gav_attr_value_id']   = $value['value_id'];  //属性值id
            $editGoodsAttrValueData[$key]['gav_attr_value_name'] = $value['value_name'];//属性值名称
        }

        //====shop_cate_goods表====
        $editShopCateGoods['scate_id']  = $inputData['shop_category']['cate_id']; //商品店铺的分类


        //====添加到数据库====
        //====使用事务====
        DB::transaction(function()
        use($editGoodsData, $editGoodsProData,$editShopCateGoods,$editGoodsProValueData,$editGoodsAttrValueData,$inputData){

            DB::table('goods')->where('goods_id',$inputData['goods_id'])->update($editGoodsData);
            $editShopCateGoods['goods_id']          = $inputData['goods_id'];
            foreach ($editGoodsProData as $k => $v){
                $editGoodsProData[$k]['pro_goods_id']     = $inputData['goods_id'];
            }
            foreach ($editGoodsProValueData as $k => $v){
                $editGoodsProValueData[$k]['pv_goods_id'] = $inputData['goods_id'];
            }
            foreach ($editGoodsAttrValueData as $k => $v){
                $editGoodsAttrValueData[$k]['gav_goods_id']   = $inputData['goods_id'];
            }

            DB::table('goods_pro')->where('pro_goods_id',$inputData['goods_id'])->delete();
            DB::table('goods_pro_value')->where('pv_goods_id',$inputData['goods_id'])->delete();
            DB::table('shop_category_goods')->where('goods_id',$inputData['goods_id'])->delete();
            DB::table('goods_attr_value')->where('gav_goods_id',$inputData['goods_id'])->delete();
            DB::table('goods_pro')->insert($editGoodsProData);
            DB::table('goods_pro_value')->insert($editGoodsProValueData);
            DB::table('shop_category_goods')->insert($editShopCateGoods);
            DB::table('goods_attr_value')->insert($editGoodsAttrValueData);

        });

        $resData = config('app.resData.success');
        $resData['msg'] = '修改成功';
        return response()->json($resData,400);

    }
}