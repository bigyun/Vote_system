<?php

return [

    /*
     * 允许url跨域
     */

    'APP_ANGULAR_URL' => env('APP_ANGULAR_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */


        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Auth'      => Illuminate\Support\Facades\Auth::class,
        'Blade'     => Illuminate\Support\Facades\Blade::class,
        'Cache'     => Illuminate\Support\Facades\Cache::class,
        'Config'    => Illuminate\Support\Facades\Config::class,
        'Cookie'    => Illuminate\Support\Facades\Cookie::class,
        'Crypt'     => Illuminate\Support\Facades\Crypt::class,
        'DB'        => Illuminate\Support\Facades\DB::class,
        'Eloquent'  => Illuminate\Database\Eloquent\Model::class,
        'Event'     => Illuminate\Support\Facades\Event::class,
        'File'      => Illuminate\Support\Facades\File::class,
        'Gate'      => Illuminate\Support\Facades\Gate::class,
        'Hash'      => Illuminate\Support\Facades\Hash::class,
        'Lang'      => Illuminate\Support\Facades\Lang::class,
        'Log'       => Illuminate\Support\Facades\Log::class,
        'Mail'      => Illuminate\Support\Facades\Mail::class,
        'Password'  => Illuminate\Support\Facades\Password::class,
        'Queue'     => Illuminate\Support\Facades\Queue::class,
        'Redirect'  => Illuminate\Support\Facades\Redirect::class,
        'Redis'     => Illuminate\Support\Facades\Redis::class,
        'Request'   => Illuminate\Support\Facades\Request::class,
        'Response'  => Illuminate\Support\Facades\Response::class,
        'Route'     => Illuminate\Support\Facades\Route::class,
        'Schema'    => Illuminate\Support\Facades\Schema::class,
        'Session'   => Illuminate\Support\Facades\Session::class,
        'Storage'   => Illuminate\Support\Facades\Storage::class,
        'URL'       => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View'      => Illuminate\Support\Facades\View::class,

    ],

    //====响应格式定义====
    'resData'=>[

        'success' => ['status'=>200,'msg'=>'success','err'=>'Null'],
        'err400'  => ['status'=>400,'msg'=>'请求错误','err'=>'Bad Request'],
        'err403'  => ['status'=>403,'msg'=>'拒绝响应','err'=>'Forbidden'],
        'err404'  => ['status'=>404,'msg'=>'请求失败','err'=>'Not Found'],
        'err500'  => ['status'=>500,'msg'=>'服务请求错误','err'=>'Internal Server Error'],
        'err503'  => ['status'=>503,'msg'=>'数据库无响应','err'=>'Service Unavailable'],
        'err504'  => ['status'=>503,'msg'=>'服务请求超时','err'=>'Gateway Timeout'],

    ],

    //sphinx
    'sphinx_Data' =>[
        'SPHINX_HOST'       =>  '192.168.1.194',
        'SPHINX_PORT'       =>  9312,
        'SPHINX_MAX_NUMS'   =>  1000,            //  最大显示条数
        'SPHINX_NAME'       =>  'test1',         //  索引名
        'SPHINX_NAME2'       =>  'test2',         //  索引名
        'SCWS_API'          =>  'http://www.xunsearch.com/scws/api.php',         //  索引名
    ],

    //====外部API接口定义====
    'IMG'=>[
        'SERVER_IMG_URL'     =>  env('SERVER_IMG_URL', 'http://localhost'),   //图片服务地址
        'UPLOAD_IMG_URL'     =>  env('UPLOAD_IMG_URL', 'http://localhost'),   //图片上传地址
        'UPLOAD_IMG_SIZE'    =>  env('UPLOAD_IMG_SIZE', '80_80'),             //图片上传裁剪大小
        'UPLOAD_IMG_ALIAS'   =>  env('UPLOAD_IMG_ALIAS', 'small'),            //图片上传裁剪别名
        'ALLOW_IMG_TYPE'     =>  env('ALLOW_IMG_TYPE', 'jpeg'),               //图片上传允许格式
        'ALLOW_IMG_SIZE_MIN' =>  env('ALLOW_IMG_SIZE_MIN', '0'),              //图片上传最大 KB
        'ALLOW_IMG_SIZE_MAX' =>  env('ALLOW_IMG_SIZE_MAX', '1000'),           //图片上传最小 KB
        'QR_IMG_LABEL'       =>  env('QR_IMG_LABEL', 'My Label'),             //二维码标签
        'QR_IMG_LOGO'        =>  env('QR_IMG_LOGO', 'storage/app/code-logo.png'),//二维码logo
        'QR_IMG_LOGO_SIZE'   =>  env('QR_IMG_LOGO_SIZE', '50'),               //二维码logo大小
    ],

    //====互亿账号配置===
    'HUYI'=>[
        'ACCOUNT' =>env('HUYI_ACCOUNT', 'cf_zengfuming'),                       //互亿账号
        'APIKEY'  =>env('HUYI_APIKEY', 'f98d13f8d87af16277fc48c943593c9a'),     //互亿密码
        'BASEURL' =>env('HUYI_BASEURL', 'http://106.ihuyi.com/webservice/sms.php'), //互亿地址
    ],

];
