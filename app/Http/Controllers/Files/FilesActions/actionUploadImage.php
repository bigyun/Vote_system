<?php

namespace App\Http\Controllers\Files\FilesActions;

/*
|--------------------------------------------------------------------------
| 图片上传
|--------------------------------------------------------------------------
| 返回图片的url地址
*/
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Common\Helper;

class actionUploadImage
{

    public static function uploadImage(Request $request){

        //====图片服务配置参数====
        $uploadUrl    = config('app.IMG.UPLOAD_IMG_URL');
        $serverUrl    = config('app.IMG.SERVER_IMG_URL');
        $allowType    = explode(',',config('app.IMG.ALLOW_IMG_TYPE'));
        $uploadSize   = config('app.IMG.UPLOAD_IMG_SIZE');
        $uploadAlias  = config('app.IMG.UPLOAD_IMG_ALIAS');
        $allowSizeMin = config('app.IMG.ALLOW_IMG_SIZE_MIN');
        $allowSizeMax = config('app.IMG.ALLOW_IMG_SIZE_MAX');

        //====图片上传位置====
        $name = $request->get('name');
        switch ($name){
            case 'color' : $query = ['fld' => 'goodsColor','tbnsize' => $uploadSize,'tbnabbr' => $uploadAlias]; break;
            case 'goods' : $query = ['fld' => 'goods','tbnsize' => $uploadSize,'tbnabbr' => $uploadAlias]; break;
            case 'editor': $query = ['fld' => 'details']; break;
            default      : $query = ['fld' => 'details']; break;
        }

        //====图片信息获取====
        $image        = $request->file('image');
        $imageType    = explode('/',$image->getMimeType());
        $imageSize    = Helper::getSizeKB($image->getSize());
        $imageTmpName = $image->getRealPath();

        //====图片格式限制====
        if($imageType[0] != 'image' || !in_array($imageType[1],$allowType)){
            $resData = config('app.resData.err400');
            $resData['msg'] = '不支持的图片格式';
            $resData['allow_type'] = $allowType;
            return response()->json($resData,400);
        }
        //====图片大小限制====
        if($imageSize < $allowSizeMin || $imageSize > $allowSizeMax ){
            $resData = config('app.resData.err400');
            $resData['msg'] = '不支持的图片尺寸';
            $resData['allow_size_min'] = $allowSizeMin.'KB';
            $resData['allow_size_max'] = $allowSizeMax.'KB';
            return response()->json($resData,400);
        }

        //====图片上传准备====
        $client = new Client();
        $response = $client->request('POST',$uploadUrl,[
            'query'     => $query,
            'multipart' => [array('name' => 'image', 'contents' => fopen($imageTmpName, 'r'))]
        ]);

        //====上传结果处理====
        $resStr = $response->getBody()->getContents();
        $resImgArr = json_decode($resStr);
        if(!$resImgArr){
            $resData = config('app.resData.err500');
            $resData['msg'] = '图片上传失败';
            return response()->json($resData,500);
        }else{
            $resImgData = $resImgArr[0];
            $newImageUrl = $serverUrl . $resImgData->NewFileUri;
            $resData = config('app.resData.success');
            $resData['data'] = $newImageUrl;
            return response()->json($resData,200);
        }

    }
}