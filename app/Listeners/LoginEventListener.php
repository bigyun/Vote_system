<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Services\Helper;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginEventListener
{
    /**
     * Create the event listener.
     *
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * 登录事件，完成用户登录
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $userData = $event->userData;
        $sessionData['userId']   = $userData->user_id;
        $sessionData['userType'] = $userData->user_type;
        $sessionData['userNick'] = $userData->user_nick;
        $sessionData['username'] = $userData->user_name;
        $sessionData['loginTime']= time();

        $userKey = $userData['userKey'];
        session([$userKey => $sessionData]);
    }
}
