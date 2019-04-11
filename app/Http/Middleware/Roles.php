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
        $roles = [];
        //如果用户咩有登录，返回到登录页面
        if(empty(session('user'))){
            return redirect('admin/login');
        }
        $admin_user = Admin_User::find(session('user') -> id);
        // 用户不存在
        if(empty($admin_user))
        {
            return redirect('admin/login') -> with('errors', '用户不存在');;
        }
        // 用户是否被禁用
        if($admin_user['login'] == 0)
        {
            return redirect('admin/login') -> with('errors', '用户已被禁用');;
        }
        // 超级管理员 拥有所有权限
        if($admin_user['role_id'] == 1)
        {
            return $next($request);
        }
        // 根据当前的登录用户获取该用户角色
        $roles = Admin_User::find(session('user') -> id) -> roles() -> get();
        if(empty(arr($roles)))
        {
            return redirect('admin/login') -> with('errors', '获取权限数据为空');
        }
        $array = [];
        if($roles[0]['state'] != 1)
        {
            return redirect("admin/login") -> with('errors', $roles['state'].'职位已被禁用');
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
        // 判断登陆后台首页
        if($route == "App\Http\Controllers\admin\AdminController@index")
        {
            return $next($request);
        }
        $file_put = [
            "date" => date("Y-m-d H:i:s", time()),
            "route" => $route
        ];
//        file_put_contents(" route.txt", json_encode($file_put)."\n\n", 8);
        // 拆分当前路由
        $in_up = explode("@",$route);
        // 搜索查询
        if($in_up[1] == "search")
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
            di("没权限");
            echo "<script>alert('没权限');</script>";
            return redirect("admin");
//            没有权限
//            跳转回登录页面
//            return redirect('admin/log');
//            返回上一层
//            return back();
        }

        return $next($request);
    }
}
