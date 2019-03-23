<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Model\Admin\Action;
use App\Http\Model\Admin\Action_Roles;
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
        $data1 = arr($li);
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
        $name = Roles::get();
        return view("admin.role.save",["list" => $list, "name" => $name]);
    }
    /**
     * 角色执行添加
     * 苏鹏
     */
    public function insert(Request $request)
    {
        $error = [];
        $list = $request -> except("_token");
        $action = $list['action_id'];
        unset($list['action_id']);
        $re = Roles::create($list);
        if(empty($re)){
            return back() -> with('errors','添加失败');
        }
        foreach($action as $v)
        {
            $data = [];
            $data = [
                "roles_id" => $re -> id,
                "action_id" => $v
            ];
            $res = Action_Roles::create($data);
            if(!$res)
            {
                $error[] = $data;
            }
        }
        if(empty($error)){
            return redirect('admin/role/index');
        }else{
            return back() -> with('errors','添加角色权限关联表失败');
        }
    }
    /**
     * 角色修改
     * 苏鹏
     */
    public function edit($id)
    {
        $checkbox = [];
        $lists = Roles::where("id", $id) -> first();
        $data = Roles::get();
        $che = Action_Roles::where("roles_id", $id) -> get();
        $che2 = arr($che);
        foreach($che2 as $c)
        {
            $checkbox[] = $c['action_id'];
        }
        $sql = "select * from action order by concat(path, id)";
        $li = DB::select($sql);
        $data1 = arr($li);
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
        return view("admin.role.edit",["list" => $list,"lists" => $lists,"data" => $data,"checkbox" => $checkbox]);
    }

    /**
     * 角色修改
     * 苏鹏
     */
    public function update(Request $request, $id)
    {
        $input = $request -> except("_token");
        $che = Action_Roles::where("roles_id", $id) -> get();
        $che2 = arr($che);
        foreach($che2 as $c)
        {
            $checkbox[] = $c['action_id'];
        }
        // 删除多的权限
        $diff1 = array_diff($checkbox,$input['action_id']);
        // 插入新增权限
        $diff2 = array_diff($input['action_id'],$checkbox);
        if(!empty($diff1))
        {
            // 删除多的权限
            foreach($diff1 as $ac)
            {
                Action_Roles::where('roles_id',$id) -> where("action_id",$ac) -> delete();
            }
        }
        if(!empty($diff2))
        {
            // 插入新增权限
            foreach($diff2 as $ac2)
            {
                $data = [];
                $data = [
                    "roles_id" => $id,
                    "action_id" => $ac2
                ];
                Action_Roles::create($data);
            }
        }
        $roles = Roles::find($id);
        $roles -> name = $input['name'];
        $roles -> descript = $input['descript'];
        $roles -> boss = $input['boss'];
        $roles -> state = $input['state'];
        $re = $roles -> save();
        $re = 0;
        if($re){
            return redirect('admin/menu/index');
        }else{
            return back() -> with('errors','修改失败');
        }
    }


    /**
     * 角色删除
     * 苏鹏
     */
    public function del($id)
    {
        $re = Roles::where('id',$id)->delete();
        $re2 = Action_Roles::where('roles_id',$id)->delete();
        if(!empty($re) && !empty($re2)){
            return "1";
        }else{
            return "0";
        }    }


    /**
     * 角色显示
     * 苏鹏
     */
    public function status()
    {
        

    }

    
}
