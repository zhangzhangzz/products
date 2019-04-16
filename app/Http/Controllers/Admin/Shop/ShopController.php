<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Model\Admin\Shop_Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Shops;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
     * 意见通过
     * 陈绪
     */
    public function opinion_pass(Request $request){

        if($request->isMethod("post")){
            $shop = new Shops();
            $id = $request->id;
            $time = time();
            $shop_text = $request->shop_text;
            $bool = $shop->pass_button($id,$time,$shop_text);
            if($bool){
                return ajax_success("更新成功",$bool);
            }else{
                return ajax_error("存储失败");
            }
        }

    }



    /**
     * 模糊查询
     * 陈绪
     */
    public function search(Request $request){

        if($request->isMethod("post")){

            $goods_type = trim(Input::get("goods_type_name")) ? trim(Input::get("goods_type_name")) : "";
            $goods_type_id = DB::table("goods_type")->where("name","like","%".$goods_type."%")->where("pid",0)->get()->toArray();
            if(count($goods_type_id) != 1){
                $goods_type_name = "";
            }else{
                $goods_type_name = $goods_type_id[0]["id"];
            }
            $shop_name = Input::get("shop_name") ? Input::get("shop_name") : "";
            $functionary = Input::get("functionary") ? Input::get("functionary") : "";
            $phone = Input::get("phone") ? Input::get("phone") : "";
            $where = [];
            if(!empty($shop_name) && empty($functionary) && empty($phone) && empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
            }
            if(!empty($shop_name) && !empty($functionary) && empty($phone) && empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
                $where[] = ["functionary","like","%".$functionary."%"];
            }
            if(!empty($shop_name) && !empty($functionary) && !empty($phone) && empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
                $where[] = ["functionary","like","%".$functionary."%"];
                $where[] = ["phone","like","%".$phone."%"];
            }
            if(!empty($shop_name) && !empty($functionary) && !empty($phone) && empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
                $where[] = ["functionary","like","%".$functionary."%"];
                $where[] = ["phone","like","%".$phone."%"];
            }
            if(!empty($shop_name) && !empty($functionary) && !empty($phone) && !empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
                $where[] = ["functionary","like","%".$functionary."%"];
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
            }
            if(empty($shop_name) && !empty($functionary) && empty($phone) && empty($goods_type_name)){
                $where[] = ["functionary","like","%".$functionary."%"];
            }
            if(empty($shop_name) && !empty($functionary) && !empty($phone) && empty($goods_type_name)){
                $where[] = ["functionary","like","%".$functionary."%"];
                $where[] = ["phone","like","%".$phone."%"];
            }
            if(empty($shop_name) && !empty($functionary) && empty($phone) && !empty($goods_type_name)){
                $where[] = ["functionary","like","%".$functionary."%"];
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
            }
            if(empty($shop_name) && !empty($functionary) && !empty($phone) && !empty($goods_type_name)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["functionary","like","%".$functionary."%"];
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
            }
            if(empty($shop_name) && empty($functionary) && !empty($phone) && empty($goods_type_name)){
                $where[] = ["phone","like","%".$phone."%"];
            }
            if(!empty($shop_name) && empty($functionary) && !empty($phone) && empty($goods_type_name)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["shop_name","like","%".$shop_name."%"];
            }
            if(empty($shop_name) && empty($functionary) && !empty($phone) && !empty($goods_type_name)){
                $where[] = ["phone","like","%".$phone."%"];
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
            }
            if(empty($shop_name) && empty($functionary) && empty($phone) && !empty($goods_type_name)){
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
            }
            if(!empty($shop_name) && empty($functionary) && empty($phone) && !empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
            }
            if(!empty($shop_name) && !empty($functionary) && empty($phone) && !empty($goods_type_name)){
                $where[] = ["shop_name","like","%".$shop_name."%"];
                $where[] = ["goods_type_id","like","%".$goods_type_name."%"];
                $where[] = ["functionary","like","%".$functionary."%"];
            }
            $shop_data = DB::table("shop")->where($where)->get()->toArray();
            foreach ($shop_data as $key=>$value){
                $shop_data[$key]["goods_type_name"] = DB::table("goods_type")->where("id",$value["goods_type_id"])->value("name");
            }

            if($shop_data){
                exit(json_encode(array("status"=>1,"code"=>0,"data"=>$shop_data),JSON_UNESCAPED_UNICODE));
            }else{
                exit(json_encode(array("status"=>1,"code"=>0,"data"=>"获取失败"),JSON_UNESCAPED_UNICODE));
            }



        }

    }


    /**
     * 显示全部数据
     * 陈绪
     */
    public function show(){

        $shop = new Shops();
        $shop_show = $shop->selects();
        if($shop_show){
            return ajax_success("获取成功",$shop_show);
        }else{
            return ajax_error("获取失败");
        }

    }


    
}