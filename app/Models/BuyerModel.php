<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Helper;

class BuyerModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'buyer_info';

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
    protected $primaryKey = 'buyer_id';

    /**
     * 此模型的表主键字段。
     *
     * @var string
     */
    protected $fillable = array(
        'buyer_id',
        'buyer_qq',
        'buyer_wangwang',
        'buyer_id_card',
        'buyer_id_card_img',
        'buyer_realname',
        'buyer_business_licence',
        'buyer_business_licence_img',
        'buyer_company_name',
        'buyer_tel',
        'buyer_icon',
        'buyer_website',
        'buyer_is_shop',
        'buyer_is_good_shop',
        'buyer_province_id',
        'buyer_province_name',
        'buyer_city_id',
        'buyer_city_name',
        'buyer_country_id',
        'buyer_country_name',
        'buyer_address',
        'buyer_rank',
        'buyer_remark',
        'buyer_state',
    );

}