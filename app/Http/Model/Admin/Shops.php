<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{

    protected $table = "shop";


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

        $shop = $this->where("audit_status",2)->get()->toArray();
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

        $shop = $this->where("audit_status",1)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }



    public function select_manage(){

        $shop = $this->where("audit_status",2)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }



    public function close_down(){

        $shop = $this->where("audit_status",3)->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop[$key]["goods_type_name"] = Goods_Type::where("id",$value["goods_type_id"])->value("name");
        }
        return $shop;

    }


}