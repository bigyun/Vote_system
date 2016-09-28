<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'goods';

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 模型的日期字段保存格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * 此模型的连接名称。
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $primaryKey = 'goods_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'goods_shop_id',
        'goods_cid1',
        'goods_cid2',
        'goods_cid3',
        'goods_cid',
        'goods_cat_name',
        'goods_brand_id',
        'goods_user_id',
        'goods_sn',
        'goods_name',
        'goods_desc',
        'goods_keyword',
        'goods_subtitle',
        'goods_market_price',
        'goods_price',
        'goods_price_type',
        'goods_stock',
        'goods_warn_stock',
        'goods_click',
        'goods_salenum',
        'goods_follow_num',
        'goods_weight',
        'goods_img',
        'goods_img_more',
        'goods_is_recom',
        'goods_transfee_type',
        'goods_attr_valuestring',
        'goods_size_group',
        'goods_state',
        'goods_reject_reason',
        'goods_last_update',
        'goods_package',
        'goods_virtual_salenum',
        'goods_publish_time',
        'goods_verify_time',
        'goods_up_time',
        'goods_down_time',
        'goods_violate_time',
        'goods_startnum',
    );

    /**
     * 关联商品规格
     */
    public function goodsPro()
    {
        return $this->hasMany('App\Models\Goods\GoodsProModel', 'pro_goods_id', 'goods_id');
    }

    /**
     * 关联商品规格值
     */
    public function goodsProValue()
    {
        return $this->hasMany('App\Models\Goods\GoodsProValueModel', 'pv_goods_id', 'goods_id');
    }

    /**
     * 关联商品等级优惠价
     */
    public function goodsBatchPrice()
    {
        return $this->hasMany('App\Models\Goods\GoodsBatchPriceModel', 'bt_goods_id', 'goods_id');
    }

    /**
     * 关联商品会员优惠价
     */
    public function goodsMemberPrice()
    {
        return $this->hasMany('App\Models\Goods\GoodsMemberPriceModel', 'gm_goods_id', 'goods_id');
    }

    /**
     * 关联商品属性值
     */
    public function goodsAttrValue()
    {
        return $this->hasMany('App\Models\Goods\GoodsAttrValueModel', 'gav_goods_id', 'goods_id');
    }

    /**
     * 关联店铺分类信息
     */
    public function shopCateGoods()
    {
        return $this->hasMany('App\Models\Shop\ShopCategoryGoodsModel', 'goods_id', 'goods_id');
    }

}