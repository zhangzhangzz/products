<?php

namespace App\Http\Controllers\Admin\Login;

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
        Session::put("user",$list);
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
        return redirect("admin/login");
    }
}
