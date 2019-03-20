<?php

namespace App\Http\Controllers\Admin\Role;

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
        return view("admin.Role.index");
    }


    /**
     * 角色添加
     * 苏鹏
     */
    public function save()
    {
        return view("admin.role.save");
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
