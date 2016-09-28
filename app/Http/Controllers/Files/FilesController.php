<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Files\FilesActions\actionUploadImage;
use App\Http\Controllers\Files\FilesActions\actionGetQrCodeUrl;
use App\Http\Controllers\Files\FilesActions\actionGetImgCode;

class FilesController extends Controller
{
    /**
     * 图片上传
     * @param $request
     * @return object
     */
    public function uploadImage(Request $request)
    {
        return actionUploadImage::uploadImage($request);
    }

    /**
     * 图片上传
     * @param $request
     * @return object
     */
    public function getQrCodeUrl(Request $request)
    {
        return actionGetQrCodeUrl::getQrCodeUrl($request);
    }

    /**
     * 生成图片验证码
     * @param $request
     * @return object
     */
    public function getImgCode(Request $request)
    {
        return actionGetImgCode::getImgCode($request);
    }


}