<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'brand';

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
    protected $primaryKey = 'brand_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'brand_logo',
        'brand_name',
        'brand_desc',
        'brand_state',
        'brand_order_master',
    );

    /**
     * 获取拥有此品牌的店铺
     */
    public function shopBrand()
    {
        return $this->belongsTo('App\Models\Brand\ShopBrandModel','brand_id','sb_id');
    }

}