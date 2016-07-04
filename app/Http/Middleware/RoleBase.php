<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Illuminate\Contracts\Auth\Guard;

class RoleBase
{
    protected $auth;

    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 登录检测
        if($this->auth->guest()){
            return redirect()->guest('login');
        }
        // 定义超级管理员常量
        define('IS_ROOT',Role::isAdministrator());

        return $next($request);
    }
}
