<?php

namespace App\Http\Common;

class Helper
{
    const USER_INFO  =  'user:info:%s';  //登录成功的信息

    /**
     * 生成一个GUID
     *
     * @return string
     */
    public static function makeGUID()
    {
        $charId = md5(uniqid(rand(), true));
        $hyphen = chr(45);
        $uuid =  substr($charId, 0, 8).$hyphen
            .substr($charId, 8, 4).$hyphen
            .substr($charId,12, 4).$hyphen
            .substr($charId,16, 4).$hyphen
            .substr($charId,20,12);
        return $uuid;
    }

    /**
     * 生成新识别码
     * @param $userData
     * @return string
     */
    public static function makeCookieUid($userData)
    {
        return md5(serialize($userData).time().mt_rand(0123,7894));
    }

    /**
     * 检查参数的完整性
     * @param array
     * @return array
     */
    public static function ckParamFull($param)
    {
        $re = ['status' => true,'msg' => '', 'err_params' => []];
        foreach ($param as $key => $value)
        {
            if($value === 'undefined' || $value == '' || $value === null)
            {
                $re['status']     = false;
                $re['msg']        = '参数不足或缺失';
                $re['err_params'][] = $key;
            }
        }
        return $re;
    }

    /**
     * 密码加密
     * @param string
     * @return string
     */
    public static function toHashPwd($pwd){
        return strtoupper(sha1(strtoupper(md5(strrev($pwd))).$pwd));
    }

    /**
     * 根据session信息获取用户ID
     * @param $sessionId
     * @return $userId
     */
    public static function getUserIdBySession($sessionId){
        $userInfo = session($sessionId);
        $userId = $userInfo['userId'];
        return $userId;
    }

    /**
     * 获取session信息
     * @param $sessionId
     * @return object
     */
    public static function getUserInfoBySession($sessionId){
        return session($sessionId);
    }

    /**
     * 文件大小转化为KB
     * @param $fileSize
     * @return float
     */
    public static function getSizeKB($fileSize){
        return $fileSize = round($fileSize / 1024 * 100) / 100;
    }

    /**
     * 文件大小转化为MB
     * @param $fileSize
     * @return float
     */
    public static function getSizeMB($fileSize){
        return $fileSize = round($fileSize / 1048576 * 100) / 100;
    }

    /**
     * 文件大小转化为GB
     * @param $fileSize
     * @return float
     */
    public static function getSizeGB($fileSize){
        return $fileSize = round($fileSize / 1073741824 * 100) / 100;
    }

    /**
     * 生成随机数
     * @param int $length
     * @param bool $onlyNum
     * @return string
     */
    public static function getRandom($length = 6 , $onlyNum = false){
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($onlyNum) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }

    /**
     * 递归获取树结构
     * @param $sonId
     * @param $dataArr
     * @param $sonName
     * @param $parentName
     * @param $sonArr
     * @return array
     */
    public static function getTreeArr($dataArr,$sonId,$sonName,$parentName,$sonArr = array())
    {
        $treeArr = array();
        foreach($dataArr as $key => $value){
            if($value[$sonName] == $sonId){
                $treeArr = $value;
                $treeArr['son_data'] = $sonArr;
                if($value['cat_parent_id'] != 0){
                    $treeArr = self::getTreeArr($dataArr,$value[$parentName],$sonName,$parentName,$treeArr);
                }
            }
        }
        return $treeArr;
    }

    /**
     * @param $goodsSn
     * @param $shopName
     * @param $brandName
     * @param $goodsSpec
     * @param $goodsAttr
     * @return string
     */
    public static function getKeyWordStr($goodsSn,$shopName,$brandName,$goodsSpec,$goodsAttr){
        $keyWord = $goodsSn . ' ';
        foreach ($goodsSpec as $specValue){
            $keyWord .= $specValue['sku']. ' ';
        }
        $keyWord .= $brandName . ' ';
        foreach ($goodsAttr as $attrValue){
            $keyWord .= $attrValue['value_name']. ' ';
        }
        $keyWord .= $shopName;
        return $keyWord;
    }

}
