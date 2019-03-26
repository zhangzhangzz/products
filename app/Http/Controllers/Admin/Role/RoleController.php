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
    // 构造方法
    public function __construct()
    {
        DB::beginTransaction(); //开启事务
    }
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
        // 查询菜单分类
        $sql = "select * from action order by concat(path, id)";
        $li = DB::select($sql);
        // 转换成数组
        $data1 = arr($li);
        $i = [];
        $data2 = [];
        $list = [];
        foreach($data1 as $v)
        {
            // 路径中有几个,号
            // 组成3维数组
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
        $data = [];
        // 获取所有参数
        $list = $request -> except("_token");
        // 去除角色中的菜单
        $action = $list['action_id'];
        unset($list['action_id']);
        // 进行添加
        $re = Roles::create($list);
        if(empty($re)){
            return back() -> with('errors','添加失败');
        }
        // 遍历已选中菜单
        foreach($action as $v)
        {
            $data[] = [
                "roles_id" => $re -> id,
                "action_id" => $v
            ];
        }
        // 插入中间表
        $res = DB::table("action_roles") -> insert($data);
        if($re && $res){
            DB::commit();  // 提交事务
            return redirect('admin/role/index');
        }else{
            DB::rollback();  // 回滚事务
            return back() -> with('errors',"添加角色权限关联表失败") -> withInput($list);
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
        // 查询所有角色的权限
        $che = Action_Roles::where("roles_id", $id) -> get();
        $che2 = arr($che);
        foreach($che2 as $c)
        {
            $checkbox[] = $c['action_id'];
        }
        // 菜单分类查询
        $sql = "select * from action order by concat(path, id)";
        $li = DB::select($sql);
        $data1 = arr($li);
        $i = [];
        $data2 = [];
        $list = [];
        foreach($data1 as $v)
        {
            // 路径中有几个,号
            // 组成3维数组
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
        $data = [];
        $res = 1;
        $input = $request -> except("_token");
        // 查出该角色所有权限
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

                $data[] = [
                    "roles_id" => $id,
                    "action_id" => $ac2
                ];
            }
            $res = DB::table("action_roles") -> insert($data);
        }
        // 进行修改
        $roles = Roles::find($id);
        $roles -> name = $input['name'];
        $roles -> descript = $input['descript'];
        $roles -> boss = $input['boss'];
        $roles -> state = $input['state'];
        $re = $roles -> save();
        if($re && $res){
            DB::commit();  // 提交事务
            return redirect('admin/role/index');
        }else{
            DB::rollback();  // 回滚事务
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
