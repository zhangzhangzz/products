<?php

namespace App\Http\Controllers\Admin\Business;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Business;
use App\Http\Model\Admin\Goods;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class BusinessController extends Controller
{
    public $s_c_n = [
        "1" => [
            "color" => "red",
            "name" => "待付款"
        ],
        "2" => [
            "color" => "orange",
            "name" => "待发货"
        ],
        "3" => [
            "color" => "green",
            "name" => "已发货"
        ],
        "4" => [
            "color" => "green",
            "name" => "已完成"
        ],
        "5" => [
            "color" => "#888",
            "name" => "待评价"
        ],
        "6" => [
            "color" => "blue",
            "name" => "退款中"
        ],
    ];
    // 构造方法
    public function __construct()
    {
        DB::beginTransaction(); //开启事务
    }
    /**
     * 交易管理显示
     *
     * 苏鹏
     */
    public function index()
    {
        $list = [];
        $sql = "select * from business as b inner join goods as g on b.good_id=g.id";
        $list = arr(DB::select($sql));
        return view("admin.business.index",["list" => json_encode($list), 's_c_n' => json_encode($this -> s_c_n)]);
    }


    /**
     * 交易管理订单详情
     *
     * 苏鹏
     */ 
    public function order()
    {
        return view("admin.business.order");
    }

    /**
     * 交易管理发货管理
     *
     * 苏鹏
     */ 
    public function send($status=0)
    {
        $i      = 0;
        $list   = [];
        if(empty($status))
        {
            $i = 1;
            $status = 2;
        }

        $data = Business::where("status", $status) -> get();
        if(!empty(arr($data)))
        {
            foreach($data as $v)
            {
                $good = [];
                $good = Goods::find($v['good_id']);
                if(!empty(arr($good)))
                {
                    unset($good['id']);
                    $v = array_merge(arr($v),arr($good));
                }
                $v['status'] = $this -> s_c_n[$v['status']];
                $list[] = $v;
            }
            $list = json_encode($list);
        }
        if($i == 1)
        {
            return view("admin.business.send",["list" => $list]);
        }else{
            return $list;
        }
    }
    /**
     * 交易管理发货管理中的发货操作
     *
     * 苏鹏
     */
    public function delivery(Request $request)
    {
        $list = $request -> except("_token");
        $db = Business::find($list['id']);
        $db -> ems = $list['emsID'];
        $db -> emsName = $list['emsName'];
        $db -> status = 3;
        $re = $db -> save();
        if($re){
            DB::commit();  // 提交事务
            return 1;
        }else{
            DB::rollback();  // 回滚事务
            return 0;
        }
    }

    /**
     * 交易管理评价
     *
     * 苏鹏
     */
    public function assess()
    {
        $sql = "select a.content,a.time,a.level,b.ems,g.pic,g.goodsname,g.realpay,u.name as username from ((assess as a INNER JOIN business as b on a.bus_id=b.id and b.status=4) INNER JOIN goods as g on b.good_id=g.id) INNER JOIN account as u on b.user_id=u.id";
        $list = DB::select($sql);
        return view("admin.business.assess",["list" => json_encode($list)]);
    }
    /**
     * 交易管理切换展示
     *
     * 苏鹏
     */
    public function search($search)
    {
        $data = [];
        $s = $search - 1;
        switch ($search)
        {
            case 1:
                $list = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id";
                $list = arr(DB::select($sql));
                return view("admin.business.index",["list" => $list, 's_c_n' => json_encode($this -> s_c_n)]);
            break;
            case 2:
                $data = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id and b.status='{$s}'";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$s];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
                break;
            case 3:
                $data = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id and b.status='{$s}'";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$s];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
                break;
            case 4:
                $data = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id and b.status='{$s}'";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$s];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
                break;
            case 5:
                $data = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id and b.status='{$s}'";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$s];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
                break;
            case 6:
                $data = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id and b.status='{$s}'";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$s];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
                break;
            case 7:
                $data = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id and b.status='{$s}'";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$s];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
                break;
            default:
                echo json_encode("错误");
                break;
        }
    }
}