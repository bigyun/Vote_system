<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsDisplayModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'goods_display';

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
    protected $primaryKey = 'gd_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'gd_display_type_id',
        'gd_goods_id',
        'gd_sort',
        'gd_img_url',
        'gd_state',
        'gd_add_time',
        'gd_actual_start_time',
        'gd_actual_end_time',
        'gd_plan_start_time',
        'gd_plan_end_time',
    );

}