<?php

namespace App\Http\Controllers\Admin\Admin_User;

use App\Http\Model\Admin\Admin_User;
use App\Http\Model\Admin\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admin_UserController extends Controller
{
    /**
     * 账号管理构造方法
     * 苏鹏
     */
    public function __construct()
    {
        DB::beginTransaction(); //开启事务
    }
    /**
     * 账号管理显示
     * 苏鹏
     */
    public function index()
    {
        $list = Admin_User::get();
        $role = Roles::get();
        return view("admin.admin_user.index",["list" => $list, "role" => $role]);
    }
    /**
     * 账号管理显示添加页面
     * 苏鹏
     */
    public function save()
    {
        $list = Roles::where("name","!=","商户") -> get();
        return view("admin.admin_user.save",["list" => $list]);
    }
    /**
     * 账号管理执行添加
     * 苏鹏
     */
    public function insert(Request $request)
    {
        $list = $request -> except("_token","spass");
        $roles = explode("|", $list['role_id']);
        $list['role_id'] = $roles['0'];
        $list['role_name'] = $roles['1'];
        // 密码加密存入数据库
        $list['password'] = Hash::make($list['password']);
        // 日期
        $list['data'] = date("Y-m-d");
        // 时间戳
        $list['time'] = time();
        // 插入数据
        $re = Admin_User::create($list);
        if($re)
        {
            $data = [
                "admin__user_id" => $re -> id,
                "roles_id" => $list['role_id']
            ];
            $res = DB::table("admin__user_roles") -> insert($data);
            if($res)
            {
                DB::commit();  // 提交事务
                return redirect('admin/admin_user/index');
            }
            return back() -> with('errors','插入角色中间表失败') -> withInput($list);
        }else{
            DB::rollback();  // 回滚事务
            return back() -> with('errors','修改失败') -> withInput($list);
        }
    }
    /**
     * 账号管理修改页面
     * 苏鹏
     */
    public function edit($id)
    {
        $list = Admin_User::where("id",$id) -> first();
        $role = Roles::get();
        return view("admin.admin_user.edit",["list" => $list, "role" => $role]);
    }
    /**
     * 账号管理修改页面
     * 苏鹏
     */
    public function update(Request $request, $id)
    {
        $res = 1;
        $data = Admin_User::find($id);
        $list = $request->except("_token");
        if (!empty($list['ypass']))
        {
            $pass = Admin_User::where("id",$id) -> first();
            // 原密码  ypass
            if(!Hash::check($list['ypass'],$pass['password']))
            {
                return back() -> with('errors','原密码不正确') -> withInput($list);
            }
            // 新密码格式
            if(!preg_match('/^[A-Za-z0-9_]{8,16}+$/',$list['password']))
            {
                return back() -> with('errors','密码格式不正确') -> withInput($list);
            }
            // 新密码  password    确认新密码    spass
            if($list['password'] != $list['spass'])
            {
                return back() -> with('errors','新密码和确认新密码不一致') -> withInput($list);
            }
            $data -> password = $list['password'];
        }

        $roles = explode("|", $list['role_id']);
        if($data -> role_id != $roles['0'])
        {
            $data -> role_id = $roles['0'];
            $data -> role_name = $roles['1'];
            $res = DB::table("admin__user_roles") -> where("admin__user_id", $id) -> update(["roles_id" => $data -> role_id]);
        }
        $data -> name = $list['name'];
        $data -> account = $list['account'];
        $data -> partment = $list['partment'];
        $data -> login = $list['login'];
        $re = $data -> save();
        if($re && $res)
        {
            DB::commit();  // 提交事务
            return redirect('admin/admin_user/index');
        }else{
            DB::rollback();  // 回滚事务
            return back() -> with('errors','修改失败') -> withInput($list);
        }
    }
    /**
     * 账号管理执行删除
     * 苏鹏
     */
    public function del($id)
    {
        $re = Admin_User::where('id', $id) -> delete();
        if($re){
            DB::commit();  // 提交事务
            return "1";
        }else{
            DB::rollback();  // 回滚事务
            return "0";
        }
    }
    /**
     * 正则验证
     * 苏鹏
     */
    public function regular(Request $request)
    {
        $input = $request -> except("_token");
        switch ($input['name']){
            // 账号
            case "account":
                $data = 0;
                if(!preg_match('/^[A-Za-z0-9_]{8,16}+$/',$input['data']))
                {
                    $data = "由8-16位数字、字母、下划线组成！";
                }
                echo json_encode($data);
                break;
            // 密码
            case "password":
                $data = 0;
                if(!preg_match('/^[A-Za-z0-9_]{8,16}+$/',$input['data']))
                {
                    $data = "由8-16位数字、字母、下划线组成！";
                }
                echo json_encode($data);
                break;
            // 部门
            case "partment":
                $data = 0;
                if(!preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',$input['data']))
                {
                    $data = "数字、字母、下划线、汉字都可以";
                }
                echo json_encode($data);
                break;
            // 姓名
            case "name":
                $data = 0;
                if(!preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$input['data']))
                {
                    $data = "汉字组成";
                }
                echo json_encode($data);
                break;

            default:
                break;
        }
    }


}
