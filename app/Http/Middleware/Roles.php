<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;

class Roles
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
        // 根据当前的登录用户获取该用户角色
        $roles = User::find(session('user') -> user_id) -> role() -> get();
        $array = [];


        foreach($roles as $k =>$v)
        {
            $p = $v -> action() -> get();
            foreach($p as $n)
            {
                $array[] = $n -> name;
            }
        }
        // 去重
        $action = array_unique($array);
        // 获取角色权限


        // 获取当前路由
//        $route = Route::current() -> getActionName();
//        dd($route);
        // 判断是否有权限访问
        if(!in_array($route, $action))
        {
//            没有权限
//            跳转回登录页面
//            return redirect('admin/log');
//            返回上一层
//            return back();
        }
        return $next($request);
    }
}
