<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/9/27
 * Time: 14:33
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Common\ReturnApi;

/*
 *
 *
 redis常规操作

 */
class RedisCommonController  extends Controller
{
    protected $redis_conn = '';
    protected $redis = '';
    protected $redis_state = '';
    protected $redis_error = '连接异常';
    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect(env('REDIS_HOST'),env('REDIS_PORT'));
        $this->redis_conn =  $this->redis->auth(env('REDIS_PASSWORD'));
        if($this->redis_conn && $this->redis ){
            $this->redis_state = 1;
        }else{
            $this->redis_state = 0;
        }
        return $this->redis;
    }

    public function test(){
        return "test";

    }
    //添加
    public function set(){
       if($this->redis_state){
           if($this->redis->set('phpredis23','yuyu')){
               $resData = ReturnApi::addResult($id=2);
               return response()->json($resData);
           }
           return response()->json(ReturnApi::addResult());
       }
        return $this->redis_error;
    }
    //删除
    public function del($key){
            if($this->redis_state){
                if($this->redis->delete($key)){
                    return response()->json(ReturnApi::deleteResult($id=2));
                }
                return response()->json(ReturnApi::deleteResult());
    }
        return $this->redis_error;
    }
    //获取
    public function get1($key){
        if($this->redis_state){

            if($this->redis->exists($key)){
                return $this->redis->get($key);
            }
            return response()->json(ReturnApi::existResult($id=3));

        }
        return $this->redis_error;

}
    //列表操作
    public function list_add($list_name,$list_value){
        if($this->redis_state){
            if($this->redis->lpush($list_name,$list_value)){
                return response()->json(ReturnApi::addResult($id=2));
            }
            return response()->json(ReturnApi::addResult());
        }
        return $this->redis_error;

    }
    //有序集合
    public function zadd_add($zadd_name,$zadd_value){
        if($this->redis_state){
            if($this->redis->zadd($zadd_name,$zadd_value)){
                return response()->json(ReturnApi::addResult($id=2));
            }
            return response()->json(ReturnApi::addResult());
        }
        return $this->redis_error;
    }
    //无序集合
    public function sadd_add($sadd_name,$sadd_value){
        if($this->redis_state){
            if($this->redis->sadd($sadd_name,$sadd_value)){
                return response()->json(ReturnApi::addResult($id=2));
            }
            return response()->json(ReturnApi::addResult());
        }
        return $this->redis_error;
    }
    //哈希
    public function hash_add($hash_name,$field,$hash_value){
        if($this->redis_state){
            if($this->redis->hset($hash_name,$field,$hash_value)){
                return response()->json(ReturnApi::addResult($id=2));
            }
            return response()->json(ReturnApi::addResult());
        }
        return $this->redis_error;
    }


}
