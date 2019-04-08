<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    /**
     * 设置管理显示
     * 陈绪
     */
    public function index(Request $request)
    {
        if($request->isMethod("post")){

            $category = DB::table("goods_type")->where("pid",0)->get()->toArray();
            $category_data = DB::table("goods_type")->where("pid","<>",0)->get()->toArray();
            return ajax_success("获取成功",array("category"=>$category,"category_data"=>$category_data));

        }
        return view("admin.Setting.index");

    }

       

    
}