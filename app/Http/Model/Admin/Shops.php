<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{

    protected $table = "shop";
    public $timestamps = false;


    /**
     * 审核状态
     * @return array
     * 陈绪
     */
    public function audit_status(){

        $shop = $this->where("audit_status",1)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;
    }


    public function select_reject(){

        $shop = $this->where("audit_status",2)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }


    public function select_pass(){

        $shop = $this->where("audit_status",3)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }



    /**
     * 经营状态
     * 陈绪
     */

    public function manage_status(){

        $shop = $this->where("manage_status",1)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }



    public function select_manage(){

        $shop = $this->where("manage_status",2)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }



    public function close_down(){

        $shop = $this->where("manage_status",3)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }



    public function shop_show($id){

        $show = $this->where("id",$id)->get()->toArray();
        foreach ($show as $key=>$value){
            $show[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
            $show[$key]["admin_name"] = Admin_User::where("shop_id",$value["id"])->value("account");
            //$show[$key]["admin_passwd"] = Admin_User::where("shop_id",$value["id"])->value("passwd");
        }
        return $show;

    }



    public function shop_opinion($id,$time,$shop_text){

        $bool = $this->where("id",$id)->update(["audit_status"=>2]);
        $shop_data = array(
            "shop_id"=>$id,
            "shop_text"=>$shop_text,
            "create_time"=>$time,
        );
        $shop_bool = Shop_Log::insert($shop_data);
        if($shop_bool) {
                $shop_arr = Shop_Log::where("shop_id",$id)->get()->toArray();
                return $shop_arr;
        }else{
            return false;
        }


    }


}