<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsGroupModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'goods_group';

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
    protected $primaryKey = 'gg_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'gg_title',
        'gg_is_home',
        'gg_platform_user_id',
        'gg_platform_username',
        'gg_add_time',
        'gg_sort',
        'gg_state',
    );

}