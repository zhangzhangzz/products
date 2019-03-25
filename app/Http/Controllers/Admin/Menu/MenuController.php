<?php
namespace App\Http\Controllers\Admin\Menu;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // 构造方法
    public function __construct()
    {
        DB::beginTransaction(); //开启事务
    }
    /**
     * 菜单显示
     * 苏鹏
     */
    public function index()
    {
        // 按排序字段排序
        $list = Action::orderBy("sort") -> get();
        return view("admin.menu.index",["list" => $list]);
    }

    /**
     * 菜单添加页面
     * 苏鹏
     */
    public function save()
    {
        // 搜索所有的菜单,按照路径查询
        $sql = "select id,name,path from action order by concat(path, id)";
        $list = DB::select($sql);
        return view("admin.menu.save",["list" => $list]);
    }
    /**
     * 菜单执行添加
     * 苏鹏
     */
    public function insert(Request $request)
    {
        $res = 1;
        // 获取所有传参
        $list = $request -> except("_token");
        $boss = $list['boss'];
        // 有没有上一级参数
        if($boss)
        {
            // 有上一级参数,查上一级的路径
            $pid = Action::where("id",$boss) -> first();
            // 父辈的路径加上父辈ID存入自己的路径中
            $list['path'] = $pid -> path . $boss . ",";
        }else{
            // 没有父辈路径 0后面加个,号
            $list['path'] = $boss . ",";
        }
        if(empty($list['sort']))
        {
            // 排序为空,查出最大排序数
            $list_sort = Action::max("sort");
            // 数据库最大排序数在加1
            $list['sort'] = $list_sort + 1;
        }else{
            // 排序改动过,进行从新排序
            // 获取所有的数据
            $oy = Action::get();
            foreach($oy as $v)
            {
                // 把所有的ID和排序单独拿出来
                $data[] = [
                    "id" => $v['id'],
                    "sort" => $v['sort']
                ];
            }
            // 把排序数传过去,ID设为0,方便修改时候传真ID过去
            $sort = [
                "id" => 0,
                "sort" => $list['sort']
            ];
            // 执行重排
            $put = $this -> sort($data,$sort);
            // 遍历,进行更新排序数据
            foreach($put as $p)
            {
                $up_action = Action::find($p['id']);
                $up_action -> sort = $p['sort'];
                $res = $up_action -> save();
            }
        }
        // 插入数据
        $re = Action::create($list);
        if($re && $res){
            DB::commit();  // 提交事务
            return redirect('admin/menu/index');
        }else{
            DB::rollback();  // 回滚事务
            return back() -> with('errors','添加失败') -> withInput($list);
        }
    }
    /**
     * 菜单修改页面
     * 苏鹏
     */
    public function edit($id)
    {
        // 查询单条数据
        $list = Action::where('id',$id) -> first();
        // 搜索所有的菜单,按照路径查询
        $sql = "select id,name,path from action order by concat(path, id)";
        $data = DB::select($sql);
        return view("admin.menu.edit",["list" => $list,"data" => $data]);
    }
    /**
     * 菜单执行修改
     * 苏鹏
     */
    public function update(Request $request, $id)
    {
        $res = 1;
        // 获取所有传参
        $input = $request -> except("_token");
        // 查询单挑数据
        $action = Action::find($id);
        $psort = $action -> sort;
        $action -> name = $input['name'];
        $action -> url = $input['url'];
        // 有没有修改上一级是谁
        if($action -> boss != $input['boss'])
        {
            // 如果修改过,把路径和师傅ID更改过来
            $action -> boss = $input['boss'];
            $pid = Action::where("id",$input['boss']) -> first();
            $action -> path = $pid -> path . $input['boss'] . ",";
        }
        $action -> state = $input['state'];
        $action -> sort = $input['sort'];
        $re = $action -> save();
        // 判断排序是否改动
        if($psort != $input['sort'])
        {
            // 排序改动过,进行从新排序
            $oy = Action::get();
            foreach($oy as $v)
            {
                // 所有人的ID和排序
                $data[] = [
                    "id" => $v['id'],
                    "sort" => $v['sort']
                ];
            }
            // 本人的路径和排序
            $sort = [
                "id" => $id,
                "sort" => $input['sort']
            ];
            // 执行重排
            $put = $this -> sort($data,$sort);
            foreach($put as $p)
            {
                // 将每一个排序进行修改
                $up_action = Action::find($p['id']);
                $up_action -> sort = $p['sort'];
                $res = $up_action -> save();
            }
        }
        if($re && $res){
            DB::commit();  // 提交事务
            return redirect('admin/menu/index');
        }else{
            DB::rollback();  // 回滚事务
            return back() -> with('errors','修改失败');
        }
    }
    /**
     * 菜单排序
     * 苏鹏
     */
    public function sort($sort, $upsort)
    {

        // 填写的排序$upsort
        // 已存在的排序$sort
        $data = [];
        if(is_array($sort) && is_array($upsort))
        {
            $num = $upsort['sort'];
            foreach($sort as $v)
            {
                if(!empty($upsort['id']) && $upsort['id'] == $v['id'])
                {
                    unset($v);
                    continue;
                }
                if($upsort['sort'] <= $v['sort'])
                {
                    $num++;
                    $v['sort'] = $num;
                    $data[] = $v;
                }
            }
            return $data;
        }
        return false;
    }
    /**
     * 角色删除
     * 苏鹏
     */
    public function del($id)
    {
        $re = Action::where('id',$id)->delete();
        if($re){
            return "1";
        }else{
           return "0";
        }
    }


    /**
     * 角色显示
     * 苏鹏
     */
    public function status()
    {
        

    }

    

}

