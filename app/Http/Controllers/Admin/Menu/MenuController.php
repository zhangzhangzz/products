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
        $data = [];
        // 搜索所有的菜单,按照路径查询
        $sql = "select * from action order by concat(path, id)";
        $arr = arr(DB::select($sql));
        foreach($arr as $v)
        {
            $nbsp = str_repeat("&nbsp;", substr_count($v['path'], ",")*30)."|--";
            $v['name'] = $nbsp.$v['name'];
            $data[] = $v;
        }
        $list = json_encode($data);
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
        $a = "";
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
            // 形成左侧导航栏A链接跳转
            $a = explode("\\", $list['url']);
            $a_function = explode("@", end($a));
            $Controller = str_replace("Controller","", $a_function[0]);
            $Controller = strtolower($Controller);
            $a_path = "/admin/".$Controller."/".$a_function[1];
            $list['a'] = $a_path;
        }else{
            // 没有父辈路径 0后面加个,号
            $list['path'] = $boss . ",";
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
        // 获取所有传参
        $input = $request -> except("_token");
        // 查询单挑数据
        $action = Action::find($id);
        $psort = $action -> sort;
        $action -> name = $input['name'];
        $action -> url = $input['url'];
        if(!empty($input['url']))
        {
            // 形成左侧导航栏A链接跳转
            $a = explode("\\", $input['url']);
            $a_function = explode("@", end($a));
            $Controller = str_replace("Controller","", $a_function[0]);
            $Controller = strtolower($Controller);
            $a_path = "/admin/".$Controller."/".$a_function[1];
            $action -> a = $a_path;
        }
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
        if($re)
        {
            DB::commit();  // 提交事务
            return redirect('admin/menu/index');
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
        $re = Action::where('id', $id) -> delete();
        if($re){
            DB::commit();  // 提交事务
            return "1";
        }else{
            DB::rollback();  // 回滚事务
           return "0";
        }
    }


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
            // 排序
            case "sort":
                $data = 0;
                if(!preg_match('/^\d*$/',$input['data']))
                {
                    $data = "只能是数字";
                }
                echo json_encode($data);
                break;
            default:
                break;
        }
    }

    

}

