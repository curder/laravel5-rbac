<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\URL;

class RoleAuth
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

//        echo Route::currentRouteName(); // 当前路由别名

        //查找并拼接出地址的别名值
        // dd($action = $request->route()->getAction()); // 获取当前请求的路由信息


        $guest = $this->auth->guest(); // 判断当前用户是否登录
        if($guest){
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }


        if(!IS_ROOT){ // 超管不受限制

            $currRouteName = Route::currentRouteName(); // 当前路由别名
            $previousUrl = URL::previous(); // 用户访问的上一页

            if(!$this->auth->user()->can($currRouteName) ){ // 如果是游客或者没有权限跳转到首页
                if($request->ajax() && ($request->getMethod() != 'GET')) {
                    return response()->json([
                        'status' => -1,
                        'code' => 403,
                        'msg' => '您没有权限执行此操作'
                    ]);
                } else {
                    return response()->view('admin.errors.403', compact('previousUrl'));
                }
            }
        }

        return $next($request);
    }
}
