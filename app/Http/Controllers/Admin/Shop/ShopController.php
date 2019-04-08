<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Shops;

class ShopController extends Controller
{


    /**
     * 店铺管理显示
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
     * 店铺审核
     * 陈绪
     */
    public function check()
    {

        return view("admin.Shop.check");
    }


    

    
}