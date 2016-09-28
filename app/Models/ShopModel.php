<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'shop_info';

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
    protected $primaryKey = 'shop_id';


    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        "shop_tel",
        "shop_name",
        "shop_mobile",
        "shop_is_cod",
        "shop_address",
        "shop_id_card",
        "shop_city_id",
        "shop_worktime",
        "shop_is_entity",
        "shop_is_return",
        "shop_nature_id",
        "shop_real_name",
        "shop_is_genuine",
        "shop_country_id",
        "shop_province_id",
        "shop_is_exchange",
        "shop_company_name",
        "shop_is_fast_delivery",
        "shop_business_licence",
        "shop_qq",
        "shop_ww",
        "shop_remark",
        "shop_website",
        "shop_seo_keyword",
    ];


}