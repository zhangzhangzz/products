<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shops extends Model
{

    protected $table = "shop";


    public function selects(){

        $shop_arr = [];
        $shop = $this->get()->toArray();
        foreach ($shop as $key=>$value){
            $shop_arr[$key]["goods_type_name"] = DB::table("goods_type")->where("id",$value["goods_type_id"])->value("name");
            $shop_arr[] = $value;
        }
        return $shop_arr;

    }

}