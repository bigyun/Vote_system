<?php

namespace App\Models\Goods;

use Illuminate\Database\Eloquent\Model;

class GoodsCategoryModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'goods_category';

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
    protected $primaryKey = 'cat_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'cat_name',
        'cat_goods_type_id',
        'cat_parent_id',
        'cat_level',
        'cat_img',
        'cat_img_thumb',
        'cat_keywords',
        'cat_desc',
        'cat_sort',
        'cat_state',
        'cat_app_abbreviation',
    );

}