<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/9/20
 * Time: 14:29
 */
namespace App\Http\Common;

/*
返回值通用类
*/
class ReturnApi {
    public static function getResult($id=1,$data)
    {
        switch($id){
            case 1:
                $resData =array(
                    'code'      => 1,
                    'msg'       => '请求失败',
                );
                return $resData;
                break;
            case 2:
                $resData =array(
                    'code'      => 0,
                    'msg'       => '请求成功',
                );
                if(!empty($data)){
                    $resData["data"]    = $data;
                }
                return $resData;
                break;

        }
    }
    public static function updateResult($id=1)
    {
        switch($id){
            case 1:
                $resData =array(
                    'code'      => 1,
                    'msg'       => '更新失败',
                );
                return $resData;
                break;
            case 2:
                $resData =array(
                    'code'      => 0,
                    'msg'       => '更新成功',
                );
                return $resData;
                break;

        }
    }

    public static function deleteResult($id=1)
    {
        switch($id){
            case 1:
                $resData =array(
                    'code'      => 1,
                    'msg'       => '删除失败',
                );
                return $resData;
                break;
            case 2:
                $resData =array(
                    'code'      => 0,
                    'msg'       => '删除成功',
                );
                return $resData;
                break;

        }
    }
    public static function addResult($id=1)
    {
        switch($id){
            case 1:
                $resData =array(
                    'code'      => 1,
                    'msg'       => '添加失败',
                );
                return $resData;
                break;
            case 2:
                $resData =array(
                    'code'      => 0,
                    'msg'       => '添加成功',
                );
                return $resData;
                break;

        }
    }
    public static function existResult($id=1)
    {
        switch($id){
            case 1:
                $resData =array(
                    'code'      => 1,
                    'msg'       => '已存在',
                );
                return $resData;
                break;
            case 2:
                $resData =array(
                    'code'      => 0,
                    'msg'       => '添加成功',
                );
                return $resData;
                break;
            case 3:
                $resData =array(
                    'code'      => 2,
                    'msg'       => '不存的键',
                );
                return $resData;
                break;

        }
    }

}