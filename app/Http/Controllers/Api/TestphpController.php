<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/9/12
 * Time: 9:38
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestphpController extends Controller
{
    //php弱类型
    public function index(Request $request)
    {
        $str1 = 'yabadabadoo';
        $str2 = 'dfyaba';
        if (strpos($str1,$str2) !== false  ) {
            //存在返回0,不存在false，if中0被当成false
            echo '<br>';
            echo  $str1 . " contains" . $str2;
        } else {
            echo '<br>';
            echo  $str1 . " does not contain" . $str2 ;
        }

    }
    //正则匹配
    public function regular(Request $request,$str)
    {
        //验证英文和数字
        if (preg_match("/^[a-zA-Z0-9]{4,16}$/",$str)){
            return '验证成功';
        }
        return '验证失败';

    }


    // Constructor

    public function __construct()
    {
        echo '__construct <br />';
    }

    // Destructor

    public function __destruct()
    {
        echo '__destruct <br />';
    }

    // Call

    public function __toString()
    {
        return '__toString<br />';
    }

}