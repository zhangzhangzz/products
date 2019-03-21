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
        dd($this -> sort());
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
            $list['path'] = $list['boss'] . ",";
        }
        if(empty($list['sort']))
        {
            $list_sort = Action::max("sort");
            $list['sort'] = $list_sort + 1;
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
        $action -> name = $input['name'];
        $action -> url = $input['url'];
        $action -> boss = $input['boss'];
        $action -> state = $input['state'];
        $action -> sort = $input['sort'];
        $re = $action -> save();
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
    public function sort($upsort=0, $sort=0)
    {

        // 填写的排序$upsort
        // 已存在的排序$sort
        $data = [];
        $sort = ["1","2","3","4","5","6","7","8"];
        $upsort = 3;
        if(in_array($upsort,$sort))
        {
            foreach($sort as $v)
            {
                if($v >= $upsort)
                {
                    $v++;
                }
                echo $v;
//                $data[] = $v;
            }
//            return $data;
        }else{
            return "不存在";
        }
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

