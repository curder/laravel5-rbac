<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;

class RoleBase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        define('IS_ROOT',Role::isAdministrator()); // 定义当前用户是否为超级管理员

        return $next($request);
    }
}
