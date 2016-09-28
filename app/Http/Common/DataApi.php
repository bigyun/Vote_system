<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/8/24
 * Time: 15:59
 */

namespace App\Http\Common;


class DataApi
{
    /**
     * get 方式请求数据中心
     * @param null $url
     * @return bool
     */
    public function getApiData($url=null)
    {
        if(!$url) return false;
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //超时时间秒
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
            return [
                'errno' => curl_errno($ch),
                'error' => curl_error($ch)
            ];
        }
        //释放curl句柄
        curl_close($ch);
        return json_decode($output,true);
    }

    /**
     * post 方式发送到数据中心
     * @param null $url
     * @param array $postData
     * @return bool
     */
    public function postApiData($url=null,$postData=[])
    {
        if(!$url) return false;
        $jsonStr=json_encode($postData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr)
            )
        );

        //超时时间秒
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $response = curl_exec($ch);

        if(curl_errno($ch))
        {
            return [
                'errno' => curl_errno($ch),
                'error' => curl_error($ch)
            ];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array($httpCode, $response);
    }

    /**
     * post 方式发送到数据中心
     * @param null $url
     * @param json array $data
     * @return bool
     */
    public function postData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data)
            )
        );
        $info = curl_exec($ch);
        curl_close($ch);
        return $info;
    }
    //分词api
    public function postFormData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($data)
            )
        );
        $info = curl_exec($ch);
        curl_close($ch);
        return $info;
    }
}