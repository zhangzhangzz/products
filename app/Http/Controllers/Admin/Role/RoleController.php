<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Model\Admin\Action;
use App\Http\Model\Admin\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    /**
     * 角色显示
     * 苏鹏
     */
    public function index()
    {
        $list = Roles::get();
        return view("admin.Role.index",["list" => $list]);
    }


    /**
     * 角色添加页面
     * 苏鹏
     */
    public function save()
    {
        $list = Action::get();
        return view("admin.role.save",["list" => $list]);
    }
    /**
     * 角色执行添加
     * 苏鹏
     */
    public function insert(Request $request)
    {
        $list = $request -> except("_token");
        dd($list);
    }
    /**
     * 角色修改
     * 苏鹏
     */
    public function edit()
    {
        return view("admin.role.edit");
    }

    /**
     * 角色修改
     * 苏鹏
     */
    public function add()
    {
        return view("admin.role.add");
    }


    /**
     * 角色删除
     * 苏鹏
     */
    public function del()
    {
        
    }


    /**
     * 角色显示
     * 苏鹏
     */
    public function status()
    {
        

    }

    
}
