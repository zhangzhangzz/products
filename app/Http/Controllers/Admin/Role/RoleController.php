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
        // 一维数组转多维数组
        $list = arr2($data1);
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
        // 一维数组转多维数组
        $list = arr2($data1);
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
            DB::commit();  // 提交事务
            return "1";
        }else{
            DB::rollback();  // 回滚事务
            return "0";
        }    }


    /**
     * 正则验证
     * 苏鹏
     */
    public function regular(Request $request)
    {
        $input = $request -> except("_token");
        switch ($input['name']){
            // 角色名称
            case "name":
                $data = 0;
                if(!preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$input['data']))
                {
                    $data = "汉字组成不可以写其他";
                }
                echo json_encode($data);
                break;
            default:
                break;
        }
    }



    /**
     * 状态jquery提交
     * 苏鹏
     */
    public function state($id,$state)
    {
        // 进行修改
        $roles = Roles::find($id);
        $roles -> state = $state;
        $re = $roles -> save();
        if($re)
        {
            DB::commit();  // 提交事务
            return 1;
        }else{
            DB::rollback();  // 回滚事务
            return 0;
        }
    }
}
