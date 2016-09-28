<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Message\MessageActions\actionGetMsgCode;

class MessageController extends Controller
{
    /**
     * 图片上传
     * @param $request
     * @return object
     */
    public function getMsgCode(Request $request)
    {
        return actionGetMsgCode::getMsgCode($request);
    }



}