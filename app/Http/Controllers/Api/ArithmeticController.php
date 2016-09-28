<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/9/14
 * Time: 9:31
 */


namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArithmeticController extends Controller
{
    //二分查找
    public function binarySearch($arr, $val, $hight, $low=0){
        while($low <= $hight){
            $mid = ceil($low + ($hight - $low) / 2);
            if($arr[$mid] == $val){
                return $mid;
            }elseif($arr[$mid] > $val){
                $hight = $mid -1;
            }else{
                $low = $mid +1;
            }
        }
        return -1;
    }
    //php算法问题
    public function index(Request $request,$id)
    {
        if(is_numeric($id)){
            /*
             * id:1  苹果分赃问题
             * id:2  猴子大王问题
             * id:3  二分查找
             */
            if($id == 1){
                for ($i = 1; ; $i++)
                {
                    if ($i%5 == 1) {
                        //第一个人取五分之一，还剩$t
                        $t = $i - round($i/5) - 1;
                        if($t % 5 == 1)
                        {
                            //第二个人取五分之一，还剩$r
                            $r = $t - round($t/5) - 1;
                            if($r % 5 == 1)
                            {
                                //第三个人取五分之一，还剩$s
                                $s = $r - round($r/5) - 1;
                                if($s % 5 == 1)
                                {
                                    //第四个人取五分之一，还剩$x
                                    $x = $s - round($s/5) - 1;
                                    if($x % 5 == 1)
                                    {
                                        //第五个人取五分之一，还剩$y
                                        $y = $x - round($x/5) - 1;
                                        if ($y % 5 == 1) {
                                            return '苹果总数:'.$i;
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } elseif($id == 2){
                $m = 5; //数到几
                $n = 78;//总数
                $monkeys = range(1, $n);
                $i=0;
                while(count($monkeys)>1){
                    if(($i+1)%$m == 0){
                        unset($monkeys[$i]);
                    }else{
                        array_push($monkeys,$monkeys[$i]);
                        unset($monkeys[$i]);
                    }
                    $i++;
                }
                return current($monkeys);
            }elseif($id == 3){
                $start_time = microtime(true);;
                $array= range(0,100000);
                $hight = count($array) - 1;
                $val = 555;
                $result =  $this->binarySearch($array,$val,$hight);
                $end_time = microtime(true);;
                echo '循环执行时间为：'.($end_time-$start_time).' s';
                echo '<br>';
                return '下标'.$result.'值'.$array[$result];


            }elseif($id == 4){
                return 'sd';
            }
            return "没有存在的参数值";
        }
        return "参数类型不对";
    }





}