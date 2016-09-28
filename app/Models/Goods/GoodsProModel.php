<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsProModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'goods_pro';

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
    protected $primaryKey = 'pro_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'pro_goods_id',
        'pro_sn',
        'pro_in_price',
        'pro_price',
        'pro_stock',
        'pro_vstock',
        'pro_salenum',
        'pro_spec_name',
        'pro_spec_value',
        'pro_spec_valuestring',
        'pro_spec_valuelist',
        'pro_img_small',
        'pro_publish_time',
    );

}