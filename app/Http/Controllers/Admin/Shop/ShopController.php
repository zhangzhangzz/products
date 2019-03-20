<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    /**
     * 角色显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.Shop.index");
    }


    

    
}