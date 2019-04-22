<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Model\Admin\Goods;
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
        return view("admin.goods.index");
    }

    /**
     * 角色显示
     * 苏鹏
     */
    public function add()
    {
        return view("admin.goods.add");
    }

    /**
     * 角色显示
     * 苏鹏
     */
    public function addclass()
    {
        return view("admin.Goods.addclass");
    }

    /**
     * 角色显示
     * 苏鹏
     */
    public function classify()
    {
        return view("admin.goods.classify");
    }

    /**
     * 角色显示
     * 苏鹏
     */
    public function recycle()
    {
        return view("admin.Goods.recycle");
    }
    

    
}