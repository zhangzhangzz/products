<?php
namespace App\Http\Controllers\Admin\Menu;
use App\Http\Controllers\Controller;

class MenuController extends Controller{



    /**
     * 菜单显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.menu.index");
    }


    /**
     * 菜单添加
     * 苏鹏
     */
    public function save()
    {
    
        return view("admin.menu.save");
    }


    /**
     * 菜单修改
     * 苏鹏
     */
    public function edit()
    {
        return view("admin.menu.edit");
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

