<?php

namespace App\Http\Controllers\Admin\Login;

use \App\Http\Model\Admin\Roles;
use App\Http\Model\Admin\Action;
use App\Http\Model\Admin\Action_Roles;
use App\Http\Model\Admin\Admin_User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * 显示登陆页面
     *
     * 苏鹏
     */
    public function index()
    {
        return view("admin.login.login");
    }
    /**
     * 判断是否登陆成功
     *
     * 苏鹏
     */
    public function doLogin(Request $request)
    {
        $checkbox = [];
        $name = [];
        $input = $request -> only("account","password");
        $list = Admin_User::where("account",$input['account']) -> first();
        if(empty($list))
        {
            return redirect("admin/login") -> with('errors','账号不正确');
        }
        // 判断密码是否正确
        if(!Hash::check($input['password'],$list['password']))
        {
            return redirect("admin/login") -> with('errors','密码不正确');
        }
        $role = Roles::find($list['role_id']);
        // 角色展示权限
        $list['show'] = $role['show'];
        // 查询是否是超级管理员
        if($list['role_id'] == 1)
        {
            // 查询所有角色的权限
            $che = arr(Action::get());
            foreach($che as $c)
            {
                $checkbox[] = $c['id'];
            }
        }else{
            // 查询所有角色的权限
            $che = arr(Action_Roles::where("roles_id", $list['role_id']) -> get());
            foreach($che as $c)
            {
                $checkbox[] = $c['action_id'];
            }
        }
        $action = arr(Action::get());
        foreach($action as $v)
        {
            if(in_array($v['id'], $checkbox))
            {
                $name[] = $v['name'];
            }
        }
        Session::put("user",$list);
        Session::put("route",$name);

        return redirect("admin");
    }
    /**
     * 退出登录
     *
     * 苏鹏
     */
    public function logout(Request $request)
    {
        $request -> session("user") -> flush();
        $request -> session("route") -> flush();
        return redirect("admin/login");
    }
}
