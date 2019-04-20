<?php

namespace App\Http\Controllers\Admin\Business;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Assess;
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
     * 交易管理搜索
     *
     * date             日期
     * gname            商品名称
     * select1          订单搜索选项
     * select1_input    订单搜索内容
     * state            订单状态
     *
     * 苏鹏
     */
    public function search(Request $request)
    {
        $se = "";
        $state = 0;
        $and = "";
        $list = [];
        $select1 = [
            // 订单编号
            "1" => "orderid",
            // 物流单号
            "2" => "ems",
            // 收货人姓名
            "3" => "name",
            // 收货人手机号
            "4" => "phone"
        ];
        // 获取所有参数
        $input = $request -> except("_token");
        if($input['data']['state'] != 1)
        {
            $state = $input['data']['state'] - 1;
            $and = " and status={$state}";
        }
        // 只有订单搜索时启用
        if(!empty($input['data']['select1_input']) && empty($input['data']['gname']) && empty($input['data']['date']))
        {
            $se = $select1[$input['data']['select1']];
            $sql = "select * from 
                    business as b 
                    inner join 
                    goods as g on b.good_id=g.id
                    where b.{$se} like '%".$input['data']['select1_input']."%'{$and} ";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        // 只有商品名称时启用
        if(!empty($input['data']['gname']) && empty($input['data']['select1_input']) && empty($input['data']['date']))
        {
            $sql = "select * from 
                    goods as g
                    inner join 
                    business as b on b.good_id=g.id
                    where g.goodsname like '%".$input['data']['gname']."%'{$and} ";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        // 只有日期时启用
        if(!empty($input['data']['date']) && empty($input['data']['select1_input']) && empty($input['data']['gname']))
        {
            $date = explode(" - ", $input['data']['date']);
            $date[0] = str_replace("-","", $date[0]);
            $date[1] = str_replace("-","", $date[1]);
            if(!empty($and))
            {
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'{$and}";
            }else{
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'";
            }
            $sql = "select * from 
                    goods as g
                    inner join 
                    business as b on b.good_id=g.id
                    where {$b_date}";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        // 订单和商品名称同时查询
        if(!empty($input['data']['select1_input']) && !empty($input['data']['gname']) && empty($input['data']['date']))
        {
            $se = $select1[$input['data']['select1']];
            $sql = "select * from 
                    business as b 
                    inner join 
                    goods as g on b.good_id=g.id
                    where b.{$se} like '%".$input['data']['select1_input']."%' 
                    and g.goodsname like '%".$input['data']['gname']."%'{$and} ";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        // 订单和日期同时查询
        if(!empty($input['data']['select1_input']) && !empty($input['data']['date']) && empty($input['data']['gname']))
        {
            $date = explode(" - ", $input['data']['date']);
            $date[0] = str_replace("-","", $date[0]);
            $date[1] = str_replace("-","", $date[1]);
            if(!empty($and))
            {
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'{$and}";
            }else{
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'";
            }
            $se = $select1[$input['data']['select1']];
            $sql = "select * from 
                    business as b 
                    inner join 
                    goods as g on b.good_id=g.id
                    where b.{$se} like '%".$input['data']['select1_input']."%' and {$b_date}";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        // 商品名称和日期同时查询
        if(!empty($input['data']['gname']) && !empty($input['data']['date']) && empty($input['data']['select1_input']))
        {
            $date = explode(" - ", $input['data']['date']);
            $date[0] = str_replace("-","", $date[0]);
            $date[1] = str_replace("-","", $date[1]);
            if(!empty($and))
            {
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'{$and}";
            }else{
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'";
            }
            $se = $select1[$input['data']['select1']];
            $sql = "select * from 
                    business as b 
                    inner join 
                    goods as g on b.good_id=g.id
                    where g.goodsname like '%".$input['data']['gname']."%' and {$b_date}";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        // 订单\商品名称\日期 同时查询
        if(!empty($input['data']['gname']) && !empty($input['data']['date']) && !empty($input['data']['select1_input']))
        {
            $date = explode(" - ", $input['data']['date']);
            $date[0] = str_replace("-","", $date[0]);
            $date[1] = str_replace("-","", $date[1]);
            if(!empty($and))
            {
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'{$and}";
            }else{
                $b_date = "DATE_FORMAT(b.date, '%Y%m%d') BETWEEN '{$date[0]}' and '{$date[1]}'";
            }
            $se = $select1[$input['data']['select1']];
            $sql = "select * from 
                    business as b 
                    inner join 
                    goods as g on b.good_id=g.id
                    where  b.{$se} like '%".$input['data']['select1_input']."%'and 
                    g.goodsname like '%".$input['data']['gname']."%' and {$b_date}";
            $data = arr(DB::select($sql));
            if(!empty($data))
            {
                foreach($data as $v)
                {
                    $v['status'] = $this -> s_c_n[$v['status']];
                    $list[] = $v;
                }
            }
        }
        return json_encode($list);
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
        $sql = "select 
                    a.content,a.content_time,a.reply_time,a.level,
                    b.id,b.ems,b.name,
                    g.pic,g.goodsname,g.realpay
                    from 
                    (assess as a INNER JOIN business as b on a.bus_id=b.id and b.status=4 and a.state=0)
                     INNER JOIN goods as g on b.good_id=g.id";
        $list = DB::select($sql);
        return view("admin.business.assess",["list" => json_encode($list)]);
    }
    /**
     * 交易管理(评价管理)回复操作
     *
     * 苏鹏
     */
    public function reply(Request $request)
    {
        $list = $request -> except("_token");
        $db = Assess::find($list['id']);
        if($list['type'] == 1)
        {
            $db -> reply = $list['reply'];
            $db -> reply_time = time();
            $db -> state = 1;
        }else{
            $db -> state = 2;
        }
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
     * 交易管理切换展示
     *
     * 苏鹏
     */
    public function show($search)
    {
        $data = [];
        $s = 0;
        // 判断是否是数字
        if(is_numeric($search))
        {
            if($search >= 2)
            {
                $s = $search - 1;
                $search = 2;
            }
        }
        switch ($search)
        {
            case 1:
                $list = [];
                $sql = "select * from business as b inner join goods as g on b.good_id=g.id";
                $list = arr(DB::select($sql));
                if(!empty($list))
                {
                    foreach($list as $v)
                    {
                        $v['status'] = $this -> s_c_n[$v['status']];
                        $data[] = $v;
                    }
                }
                return json_encode($data);
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
            case "dcl":
                $list = Assess::where("state","0") -> get();
                return json_encode($list);
                break;
            case "qb":
                $sql = "select 
                    a.content,a.content_time,a.reply_time,a.level,a.reply,a.state,
                    b.id,b.ems,b.name,
                    g.pic,g.goodsname,g.realpay
                    from 
                    (assess as a INNER JOIN business as b on a.bus_id=b.id and b.status=4 and (a.state=1 or a.state=2))
                     INNER JOIN goods as g on b.good_id=g.id";
                $list = DB::select($sql);
                return json_encode($list);
                break;
            default:
                echo json_encode("错误");
                break;
        }
    }
}