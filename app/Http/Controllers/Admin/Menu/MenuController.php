<?php
namespace App\Http\Controllers\Admin\Menu;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller{



    /**
     * 菜单显示
     * 苏鹏
     */
    public function index()
    {
        $list = Action::orderBy("sort") -> get();
        return view("admin.menu.index",["list" => $list]);
    }

    /**
     * 菜单添加页面
     * 苏鹏
     */
    public function save()
    {
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
        $list = $request -> except("_token");
        $boss = $list['boss'];
        if($boss)
        {
            $pid = Action::where("id",$boss) -> first();
            $list['path'] = $pid -> path . $boss . ",";
        }else{
            $list['path'] = $boss . ",";
        }
        if(empty($list['sort']))
        {
            $list_sort = Action::max("sort");
            $list['sort'] = $list_sort + 1;
        }else{
            // 排序改动过,进行从新排序
            $oy = Action::get();
            foreach($oy as $v)
            {
                $data[] = [
                    "id" => $v['id'],
                    "sort" => $v['sort']
                ];
            }
            $sort = [
                "id" => 0,
                "sort" => $list['sort']
            ];
            $put = $this -> sort($data,$sort);
            foreach($put as $p)
            {
                $up_action = Action::find($p['id']);
                $up_action -> sort = $p['sort'];
                $up_action -> save();
            }
        }
        $re = Action::create($list);
        if($re){
            return redirect('admin/menu/index');
        }else{
            return back();
        }
    }
    /**
     * 菜单修改页面
     * 苏鹏
     */
    public function edit($id)
    {
        $list = Action::where('id',$id) -> first();
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
        $input = $request -> except("_token");

        $action = Action::find($id);
        $psort = $action -> sort;
        $action -> name = $input['name'];
        $action -> url = $input['url'];
        if($action -> boss != $input['boss'])
        {
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
                $data[] = [
                    "id" => $v['id'],
                    "sort" => $v['sort']
                ];
            }
            $sort = [
                "id" => $id,
                "sort" => $input['sort']
            ];
            $put = $this -> sort($data,$sort);
            foreach($put as $p)
            {
                $up_action = Action::find($p['id']);
                $up_action -> sort = $p['sort'];
                $up_action -> save();
            }
        }
        if($re){
            return redirect('admin/menu/index');
        }else{
            return back();
        }
    }
    /**
     * 菜单排序
     * 苏鹏
     */
    public function sort($sort, $upsort=0)
    {

        // 填写的排序$upsort
        // 已存在的排序$sort
        $data = [];
//        $sort = ["1","2","3","4","5","6","7","8"];
//        $upsort = [
//            "id" => 2,
//            "sort" => 4
//        ];
        if(is_array($sort) && is_array($upsort))
        {
            $num = $upsort['sort'];
            foreach($sort as $v)
            {
                if($upsort['id'] == $v['id'])
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

