<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Model\Admin\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageController extends Controller
{
    /**
     * 商品管理展示出售中
     *
     * 苏鹏
     */
    public function index()
    {
        $show = session("user") -> show;
        if($show)
        {
            $list = Goods::where("num", ">", "0") -> get();
        }else{
            $list = Goods::where("admin_user_id",session("user") -> id)
                -> where("num", ">", "0")
                -> get();
        }
        return view("admin.Goods.manage",["list" => $list]);
    }
    /**
     * 商品管理切换展示
     *
     * 苏鹏
     */
    public function show($data)
    {
        $show = session("user") -> show;
        switch ($data)
        {
            case 1:
                // 后台管理员还是商户,如果是商户只展示自己的商品
                if($show)
                {
                    $list = Goods::where("num", ">", "0") -> get();
                }else{
                    $list = Goods::where("admin_user_id",session("user") -> id)
                        -> where("num", ">", "0")
                        -> get();
                }
                return $list;
                break;
            case 2:
                if($show)
                {
                    $list = Goods::where("num","=","0") -> get();
                }else{
                    $list = Goods::where("admin_user_id",session("user") -> id)
                        -> where("num", "=", "0")
                        -> get();
                }
                return $list;
                break;
            default:
                echo json_encode("错误");
                break;
        }
    }

}
