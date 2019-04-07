<?php

namespace App\Http\Middleware;

use App\Http\Model\Admin\Admin_User;
use Closure;
use Illuminate\Routing\Route;

class Roles
{
    /**
     * 权限判定
     * 苏鹏
     */
    public function handle($request, Closure $next)
    {
        //如果用户咩有登录，返回到登录页面
        if(empty(session('user'))){
            return redirect('admin/login');
        }
        // 根据当前的登录用户获取该用户角色
        $roles = Admin_User::find(session('user') -> id) -> roles() -> get();
        $array = [];
        if($roles[0]['state'] != 1)
        {
            return redirect("admin/login") -> with('errors', $roles['state'].'已被禁用');
        }
        foreach($roles as $k =>$v)
        {
            $p = $v -> action() -> get();
            foreach($p as $n)
            {
                $array[] = $n -> url;
            }
        }
        // 去重
        $action = array_filter(array_unique($array));
        // 获取角色权限
        // 获取当前路由
        $route = \Route::current() -> getActionName();
        // 拆分当前路由
        $in_up = explode("@",$route);
        // 正则验证,直接通过
        if($in_up[1] == "regular")
        {
            return $next($request);
        }
        // 如果有添加权限就可以使用执行添加
        if($in_up[1] == "insert")
        {
            $save = $in_up[0]."@save";
            if(in_array($save, $action))
            {
                $action[] = $route;
            }
        }
        // 如果有修改权限就可以使用执行修改
        if($in_up[1] == "update")
        {
            $save = $in_up[0]."@edit";
            if(in_array($save, $action))
            {
                $action[] = $route;
            }
        }
        // 判断是否有权限访问
        if(!in_array($route, $action))
        {
            dd("没权限");
//            没有权限
//            跳转回登录页面
//            return redirect('admin/log');
//            返回上一层
//            return back();
        }
        return $next($request);
    }
}
