<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Model;

class ShopBrandModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'shop_brand';

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
    protected $primaryKey = 'sb_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'sb_shop_id',
        'sb_brand_id',
        'sb_authorization',
        'sb_add_time',
        'sb_confirm_time',
        'sb_admin_name',
        'sb_reject_reason',
        'sb_state',
    );

    /**
     * 关联品牌
     */
    public function brand()
    {
        return $this->hasMany('App\Models\Brand\BrandModel', 'sb_id', 'brand_id');
    }

}