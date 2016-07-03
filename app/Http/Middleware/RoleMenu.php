<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;

/**
 * 创建后台菜单
 * Class RoleMenu
 * @package App\Http\Middleware
 */
class RoleMenu
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
        view()->share('menuList',Permission::getMenu()); // 变量共享

        return $next($request);
    }




}
