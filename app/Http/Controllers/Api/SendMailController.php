<?php


/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2016/8/18
 * Time: 15:13
 */
namespace App\Http\Controllers\Api;
use Config;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
        //发送邮件
        public function send(Request $request)
        {
            if ($request->isMethod('post')) {
                $title = $request->title;
                $content = $request->content;
                $to_mail =  $request->to;
                if(!empty($title) && !empty($content) && !empty($to_mail)){
                    $flag = Mail::send('emails.test',['title'=>$title,'content'=>$content],function($message) use ($to_mail,$title){
                        $message ->to($to_mail)->subject($title);
                    });
                    if($flag){
                        return 0;
                    }else{
                        return 1;
                    }
                }
                return 2;//参数不正确
            }
            return 3;//必须为post
        }

}