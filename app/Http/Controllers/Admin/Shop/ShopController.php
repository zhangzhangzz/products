<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Model\Admin\Shop_Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Shops;

class ShopController extends Controller
{


    /**
     * 店铺管理待审核显示
     * 陈绪
     */
    public function index(Request $request)
    {
        if($request->isMethod("post")){
            $shop = new Shops();
            $shop_data = $shop->audit_status();
            return ajax_success("获取成功",$shop_data);
        }
        return view("admin.Shop.index");
    }


    /**
     * 店铺驳回审核
     * 陈绪
     */
    public function check(Request $request)
    {
        if($request->isMethod("post")){
            $shop = new Shops();
            $shop_data = $shop->select_reject();
            return ajax_success("获取成功",$shop_data);
        }
    }



    /**
     * 店铺通过审核
     * 陈绪
     */
    public function shop_pass(Request $request){

        if($request->isMethod("post")){
            $shop = new Shops();
            $shop_data = $shop->select_pass();
            return ajax_success("获取成功",$shop_data);
        }

    }



    /**
     * 店铺经营中
     * 陈绪
     */
    public function shop_manage(Request $request){

        if($request->isMethod("post")){
            $shop = new Shops();
            $shop_data = $shop->manage_status();
            return ajax_success("获取成功",$shop_data);
        }

    }



    /**
     * 店铺审核中
     * 陈绪
     */
    public function shop_audit(Request $request){

        if($request->isMethod("post")){
            $shop = new Shops();
            $shop_data = $shop->select_manage();
            return ajax_success("获取成功",$shop_data);
        }

    }




    /**
     * 店铺已停业
     * 陈绪
     */
    public function shop_down(Request $request){

        if($request->isMethod("post")){
            $shop = new Shops();
            $shop_data = $shop->close_down();
            return ajax_success("获取成功",$shop_data);
        }

    }



    /**
     * 店铺审核
     * 陈绪
     */
    public function audit($id){

        $shop = new Shops();
        $shop_list = $shop->shop_show($id);
        return view("admin.shop.check",["shop_list"=>$shop_list]);

    }


    /**
     * 意见反馈
     * 陈绪
     */
    public function opinion(Request $request){

        if($request->isMethod("post")){
            $shop = new Shops();
            $id = $request->id;
            $time = time();
            $shop_text = $request->shop_text;
            $bool = $shop->shop_opinion($id,$time,$shop_text);
            if(!empty($bool)){
                return ajax_success("存储成功",$bool);
            }else{
                return ajax_error("存储失败");
            }
        }

    }



    /**
     * 模糊查询
     * 陈绪
     */
    public function search(){

        

    }


    
}