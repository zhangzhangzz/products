<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Model\Admin\Action;
use App\Http\Model\Admin\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        $sql = "select * from action order by concat(path, id)";
        $li = DB::select($sql);
        $data1 = json_decode(json_encode($li), true);
        $i = [];
        $data2 = [];
        $list = [];
        foreach($data1 as $v)
        {
            if(substr_count($v['path'], ",") == 1)
            {
                $list[$v['id']] = $v;
            }
            if(substr_count($v['path'], ",") == 2)
            {
                $i[] = $v['id'];
                $data2[] = $v;
            }
            if(substr_count($v['path'], ",") == 3)
            {
                $key = array_search($v['boss'], $i);
                $data2[$key][] = $v;
                $key = "";
            }
        }
        foreach($data2 as $p)
        {
            $list[$p['boss']][] = $p;
        }
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
