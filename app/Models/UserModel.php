<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Common\Helper;

class UserModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'user';

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
    protected $primaryKey = 'user_id';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = array(
    'user_id',
    'user_mobile',
    'user_is_mobile',
    'user_email',
    'user_is_email',
    'user_name',
    'user_nick',
    'user_pwd',
    'user_pay_pwd',
    'user_money',
    'user_frozen_money',
    'user_reg_time',
    'user_last_login',
    'user_type',
    'user_login_times',
);

    /**
     * 注册用户
     * @param array
     * @return object
     */
    public static function register($userData){

        //=====创建用户名=====
        //=====密码加密=======
        $GUID        = Helper::makeGUID();
        $userHashPwd = Helper::toHashPwd($userData['user_pwd']);

        $dataArr = [
            'user_mobile'   =>$userData['user_mobile'],
            'user_is_mobile'=>1,
            'user_name'     =>$GUID,
            'user_nick'     =>$userData['user_mobile'],
            'user_pwd'      =>$userHashPwd,
            'user_reg_time' =>time(),
            'user_type'     =>$userData['user_pwd'],
        ];

        return self::create($dataArr);
    }

}