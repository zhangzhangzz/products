<?php

namespace App\Http\Controllers\Admin\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{

    /**
     * 角色显示
     * 苏鹏
     */
    public function index()
    {
        return view("admin.Goods.index");
    }

    /**
     * 角色显示
     * 苏鹏
     */
    public function add()
    {
        return view("admin.Goods.add");
    }

    /**
     * 角色显示
     * 苏鹏
     */
    public function classify()
    {
        return view("admin.Goods.classify");
    }


    

    
}