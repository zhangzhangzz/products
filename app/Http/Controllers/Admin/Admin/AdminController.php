<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AdminController extends Controller{


    /**
     * 账号管理显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.admin.index");
    }


    /**
     * 账号管理报存
     * 苏鹏
     */
    public function save()
    {
        return view("admin.admin.save");
    }


    /**
     * 账号管理修改
     * 苏鹏
     */
    public function edit()
    {
        return view("admin.admin.edit");
    }

    /**
     * 账号管理添加
     * 苏鹏
     */ 
    public function add()
    {
        return view("admin.admin.add");
    }


    /**
     * 账号管理删除
     * 苏鹏
     */
    public function del()
    {
        
    }


    /**
     * 账号管理状态修改
     * 苏鹏
     */
    public function status()
    {
        

    }


    /**
     * 账号管理状态更新
     */
    public function updata(){


    }




}