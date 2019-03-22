<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    /**
     * 店铺管理显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.Shop.index");
    }

    /**
     * 店铺审核
     * 苏鹏
     */
    public function check()
    {
        return view("admin.Shop.check");
    }


    

    
}