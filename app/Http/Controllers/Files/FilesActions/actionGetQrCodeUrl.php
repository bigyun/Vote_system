<?php

namespace App\Http\Controllers\Files\FilesActions;

/*
|--------------------------------------------------------------------------
| 二维码生成
|--------------------------------------------------------------------------
| 返回生成的二维码url地址
*/
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;

class actionGetQrCodeUrl
{

    public static function getQrCodeUrl(Request $request){

        //====二维码内容====
        $codeText     = $request->get('code_text');
        $codeLabel    = config('app.IMG.QR_IMG_LABEL');
        $codeLogo     = config('app.IMG.QR_IMG_LOGO');
        $codeLogoSize = config('app.IMG.QR_IMG_LOGO_SIZE');

        //====创建二维码内容====
        $qrCode = new QrCode();
        $imageCode = $qrCode
            ->setText($codeText)
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(['r'=>0,'g'=>0,'b'=>0,'a'=>0])
            ->setBackgroundColor(['r'=>255,'g'=>255,'b'=>255,'a'=>0])
            ->setLogo($codeLogo)
            ->setLogoSize($codeLogoSize)
            ->setLabel($codeLabel)
            ->setLabelFontSize(16)
            ->get();

        //====存入本地临时文件====
        $tempImageCode = tmpfile();
        fwrite($tempImageCode, $imageCode);

        //====将二维码上传到图片服务器====
        $client    = new Client();
        $query     = ['fld' => 'qr_image'];
        $uploadUrl = config('app.IMG.UPLOAD_IMG_URL');
        $serverUrl = config('app.IMG.SERVER_IMG_URL');
        $response = $client->request('POST',$uploadUrl,[
            'query'     => $query,
            'multipart' => [array('name' => 'image', 'contents' => $tempImageCode)]
        ]);

        $resStr = $response->getBody()->getContents();
        $resImgArr = json_decode($resStr);

        if(!$resImgArr){
            $resData = config('app.resData.err500');
            $resData['msg'] = '二维码生成失败';
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