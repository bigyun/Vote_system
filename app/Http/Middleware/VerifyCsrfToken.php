<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * 这里写入的url将不受跨站请求保护
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * 这里选择开启或者关闭跨站请求保护
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 使用CSRF
        //return parent::handle($request, $next);
        // 禁用CSRF
        return $next($request);
    }
}
