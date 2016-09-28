<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/9/27
 * Time: 19:04
 */

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\RedisCommonController;


class VoteController extends RedisCommonController
{

    public function get($key){
        return $this->get1($key);
    }


}